$(document).ready(function(){

	let $urlfield,
        $editPost,
        $sharePost,
		$add_data,$loader,$add_data_f;
		$urlfield=_("#url_field");
        $editPost=_(".contact-info-outer");
        $sharePost=_(".shareForm");
		$add_data=_("#share");
        $add_data_f=_("#plus");
        $loader = _(".loader");

    _click($add_data, function() {
    if(username != null) {
    	let url = $("#url_field").val();
    	if(url == '') { $("#url_field").css("border-color", "RED"); toastr.error('phew... You forgot to enter URL');} else {

        let verifyUrl = getDomain(url);
        	if(isValidURL(url)){ 
        		if(verifyUrl.match(/steemit.com/g)) { 
        		 toastr.error('phew... Steem URL not allowed'); return false;} else{ _hide($add_data_f); _show($loader); _fetch("helper/main.php",url); return; }
        	}
    	}
    }   else {  toastr.error('hmm... You must be login!'); return false; }     
    });    
	function _fetch(apiUrl,webUrl) {
        $.post(apiUrl,{url:webUrl},function(response){
            //console.log(response);
            
            let res = JSON.parse(response);
            window.location.replace("editDetails.php?url="+encodeURIComponent(res.url)+"&title="+encodeURIComponent(res.title)+"&imgUrl="+encodeURIComponent(res.imgUrl)+"&details="+encodeURIComponent(res.des));
            //console.log("Response array: "+res.imgUrl);

        });
    }
	function isValidURL(url){
        var RegExp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        if(RegExp.test(url)) {
            return true;
        } else {
            toastr.error('phew... Enter a valid url');
            return false;
        }
    }
    function _click(se,callback) {
        _(se).click(function (e) {
            callback(e);
        });
    }
    function _show(e) {
        e.css('display','block');
    }
    function _hide(e) {
        e.css('display','none');
    }
    function _(e) {
        return $(e);
    }
	function getDomain(url) {
        let hostName = getHostName(url);
        let domain = hostName;

        if (hostName != null) {
            let parts = hostName.split('.').reverse();
            if (parts != null && parts.length > 1) {
                domain = parts[1] + '.' + parts[0];
                if (hostName.toLowerCase().indexOf('.co.uk') != -1 && parts.length > 2) {
                    domain = parts[2] + '.' + domain;
                }
            }
        }
        return domain;
    }
    function getHostName(url) {
        var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
        if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
            return match[2];
        }
        else {
            return null;
        }
    }
    $('.shareme').click(function () {
        let text_words = $.trim($('[name="description"]').val()).split(' ').filter(function(v){return v!==''}).length;
        if(text_words < 20){
            showModalError(
                "Make Sure..",
                "Write minimum 30 words to explain how this share is useful for community.",
                ""
                );
            return false;  
        }
        if($('.catg').val() == "0"){
            $('.catg').css("border-color", "RED");
            showModalError(
                "uh-oh..",
                "You must Select an appropriate Category",
                ""
                );
            return false;  
        }
        if ($('.tags').val().length === 0) {
            $('.tags').css("border-color", "RED");
            showModalError(
                "uh-oh..",
                "You must add related tags",
                ""
                );
            return false; 
        }
        if ($('.title_field').val() == "") {
            showModalError(
                "uh-oh..",
                "Title Should not be empty!",
                ""
                );
            return false;
        } 
    });

    function showModalError(title, content, callback) {
    $("#alert-title-error").text(title);
    $("#alert-content-error").html(content);
    $("#alert-modal-error").modal("show");
    $("#alert-modal-error").on("hidden.bs.modal", function(e) {
        callback();
    });
    }
      function showModalSuccess(title, content, callback) {
    $("#alert-title-success").text(title);
    $("#alert-content-success").html(content);
    $("#alert-modal-success").modal("show");
    $("#alert-modal-success").on("hidden.bs.modal", function(e) {
        callback();
    });
    }

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-bottom-center",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "500",
      "timeOut": "2000",
      "extendedTimeOut": "500",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

    //comt
    $('.cmt_bt').click(function () {
        if(username != null) {
            if (!$.trim($('[name="cmt_body"]').val())) {
                toastr.error('It seems you forgot to post comment');
                return false;  
            }

        } else {
            toastr.error('hmm... You must be login!'); 
            return false;
        };
    });

    //post modal data
    //$('#postModal').on('hidden.bs.modal', function(e) {
        //$('#result').html("");
        //$(this).find(".cmt_section").remove();
            //location.reload();
            
    //});
});
// solve me
    var options = {
        target: '#output-msg',
        url: 'helper/solve.php',
        success: function() {},
    }
    $('#logsubmit').submit(function() {
        $(this).ajaxSubmit(options)
        return !1
    });

// star ratings
function postToControll() {
    for (i = 0; i < document.getElementsByName('star').length; i++) {
        if(document.getElementsByName('star')[i].checked == true) {
            var ratingValue = document.getElementsByName('star')[i].value;
                break;
            }
        }
        //alert(ratingValue);
        $('#myRatingz').val(ratingValue);
};

//dvd modal
$('.latest-post-section').on("click", ".hov_me", function() {
   //alert('called');
    // we want to copy the 'id' from the button to the modal
    var mypermlink = $(this).attr("data-permlink");
    var authorname = $(this).attr("data-author");

        var datat = {
            ath: authorname,
            plink: mypermlink
        };
            $.ajax({
                type: "POST",
                url: "helper/verify_post.php",
                data: datat,
                success: function(data) {
                        try {
                            var response = JSON.parse(data)
                            if(response.error == true) {
                                $('#upvotefail').modal('show');
                            } else {
                                    $('#likes').modal('show');
                            }
                        } catch (err) {
                            alert('Sorry. Server response is malformed.')
                        }
                    }
            });

    $("#author_rate").val(authorname);
    $("#permlink_rate").val(mypermlink);
});

//post modal
$('#content').on("click", ".post_detail", function() {
   //alert('called');
    // we want to copy the 'id' from the button to the modal
    var postpermlink = $(this).attr("data-permlink");
    var postauthor = $(this).attr("data-author");
    var permlinkD = steem.formatter.commentPermlink(postauthor, postpermlink);

    $("#postauthor").val(postauthor);
    $("#postpermlink").val(postpermlink);
    $("#userauth").val(user_auth);
    $("#c_author").val(username);
    $("#c_permlink").val(permlinkD);


    steem.api.getContent(postauthor , postpermlink, function(err, res) {
        //console.log(res);

        let metadata = JSON.parse(res.json_metadata);
        let img = new Image();
        if (typeof metadata.image === "string"){
            img.src = metadata.image.replace("?","?");
        } else {
            img.src = metadata.image[0];
        }
        json_metadata = metadata;
        let category = metadata.category;
        if (category === undefined) { category = "dlike"; } else {category = metadata.category;}
        let posttags = metadata.tags.map(function (meta) { if (meta) return '<a href="#">' + meta + ' </a>' });
        let title = res.title;
        let author = res.author;
        let auth_img = "https://steemitimages.com/u/" + author + "/avatar";
        let post_description = metadata.body.replace(/<[\/]{0,1}(p)[^><]*>/ig,"");
        //let post_body = $(post_description).text();

        $('.mod-auth').html(author);
        $('.mod-title').html(title);
        $('.mod-thumb').attr("src", img.src);
        $('.mod-authThumb').attr("src", auth_img);
        $('.mod-tags').html(posttags);
        $('.mod-post').text(post_description);
    });    
    
        let comment = []    
        steem.api.getContentReplies(postauthor, postpermlink, function(err, result) {
            showMainComment(0, result);
        });    
             //for (var i = 0; i < result.length; i++) {
        function showMainComment(i, commentsArray) {
            $comment = commentsArray[i];
            console.log($comment);
            if($comment !=null ){
            let metadata;
                if ($comment.json_metadata && $comment.json_metadata.length > 0){
                    metadata = JSON.parse($comment.json_metadata);
                }
            if(metadata && metadata.community == "dlike"){
                    let a_p = "https://dlike.io/@"+$comment.author;
                    let $commentbody = $comment.body.replace(/<[\/]{0,1}(p)[^><]*>/ig,"");

                $(".cmt_section").append('<li class="comment prml-'+$comment.permlink+'">\n' +
                    '<div class="comment-wrap">\n' +
                    '<div class="comment-info">\n' +
                    '<div class="commenter-thumb"><img src="https://steemitimages.com/u/'+$comment.author+'/avatar" class="img-fluid" alt=""></div>\n' +
                    '<div class="commenter-info">\n' +
                    '<span class="commenter-name">'+$comment.author+'</span>\n' +
                    '<span class="date">'+moment.utc($comment.created + "Z", "YYYY-MM-DD  h:mm:ss").fromNow()+'</span>\n' +
                    '</div>\n' +
                    '<div class="reply"><button type="button" class="reply-button">Reply</button></div>\n' +
                    '</div>\n' +
                    '<div class="comment-body">'+$commentbody+'</div>\n' +
                    '</div>\n' +
                    '</li>');
            }        
            }
        }
       

});

// hov element
$('.hov-item').hover(function() {
     $(this).find('.hov-title').fadeIn(200);
}, function() {
$(this).find('.hov-title').fadeOut(100);

});

//upvote
var rangeSlider = document.getElementById("rs-range-line");
var rangeBullet = document.getElementById("rs-bullet");
rangeSlider.addEventListener("input", showSliderValue, false);

function showSliderValue() {
  rangeBullet.innerHTML = rangeSlider.value;
}

$('.latest-post-section').on("click", ".upvoting", function() {
    var votepermlink = $(this).attr("data-permlink");
    var voteauthor = $(this).attr("data-author");

    $("#vote_author").val(voteauthor);
    $("#vote_permlink").val(votepermlink);

});

$('.upme').click(function() {
  
    var upvoteValue = $('#rs-range-line').val();
    var weight = parseInt(upvoteValue);
    //alert(upvoteValue)
    var v_authorname = $("#vote_author").val();
    var v_permlink = $("#vote_permlink").val();
    var datav = {
        v_permlink: v_permlink,
        v_author: v_authorname,
        vote_value: upvoteValue
    };

    if(username != null) { 
    $('#upvoting-bar').hide();
    $('#upvoting-status').show();         
            $.ajax({
                type: "POST",
                url: "helper/vote.php",
                data: datav,
                success: function(data) {
                    //console.log(data);
                    try {
                        var response = JSON.parse(data)
                        if(response.error == true) {
                            toastr.error('There is some issue!'); 
                            $('#upvoteModal').modal('hide');
                            $('#upvoting-status').hide();
                            $('#upvoting-bar').show();
                            return false;
                        } else {
                            //$('#vote_icon').css("color", "RED");
                            toastr.success('upVote done successfully!'); 
                            $('#upvoteModal').modal('hide');
                            $('#upvoting-status').hide(); 
                            $('#upvoting-bar').show();
                            }
                        } catch (err) {
                            toastr.error('Sorry. Server response is malformed.');
                            $('#upvoteModal').modal('hide');
                            $('#upvoting-status').hide(); 
                            $('#upvoting-bar').show();
                    }
                },
                //error: function(xhr, textStatus, error){
                //      console.log(xhr.statusText);
                //       console.log(textStatus);
                //        console.log(error);
                //}
            });
    } else {
        toastr.error('hmm... You must be login!'); 
        $('#upvoteModal').modal('hide');
        return false;
    };
});

//chat
function ChatbroLoader(chats,async){async=!1!==async;var params={embedChatsParameters:chats instanceof Array?chats:[chats],lang:navigator.language||navigator.userLanguage,needLoadCode:'undefined'==typeof Chatbro,embedParamsVersion:localStorage.embedParamsVersion,chatbroScriptVersion:localStorage.chatbroScriptVersion},xhr=new XMLHttpRequest;xhr.withCredentials=!0,xhr.onload=function(){eval(xhr.responseText)},xhr.onerror=function(){console.error('Chatbro loading error')},xhr.open('GET','//www.chatbro.com/embed.js?'+btoa(unescape(encodeURIComponent(JSON.stringify(params)))),async),xhr.send()}
ChatbroLoader({encodedChatId: '938nz'});