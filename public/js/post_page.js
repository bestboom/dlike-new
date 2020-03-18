steem.api.getContent(post_author , post_permlink, function(err, res) {
        //console.log(res);
        res["voterlist"] = '';
        let metadata = JSON.parse(res.json_metadata);
        let img = new Image();
        if (typeof metadata.image === "string"){
            img.src = metadata.image.replace("?","?");
        } else {
            img.src = metadata.image[0];
        }
        if (metadata.hasOwnProperty('type')) {console.log('type exist');} else {console.log('type not exist');}
        //image or youtube
        let thumbnail = '<img src="' + img.src + '" alt="' + res.title + '" onerror="this.src=/images/post/8.png" class="card-img-post img-fluid">';

            var getLocation = function(href) {
                    var l = document.createElement("a");
                    l.href = href;
                    return l;
                };
                var url = getLocation(metadata.url);
                var youtubeAnchorTagVariableClass = '';
                if(url.hostname == 'www.youtube.com' || url.hostname == 'youtube.com' || url.hostname == 'youtu.be' || url.hostname == 'www.youtu.be'){
                    //alert(url);
                    youtubeAnchorTagVariableClass = 'youtubeAnchorTagVariableClass_' + '';
                    if(url.search != ''){
                        let query = url.search.substr(1); //remove ? from begning
                        //query = query.split('&')
                            let splited = query.split('=');
                            if(splited[0] == 'v'){
                                thumbnail = '<span class="embed-responsive embed-responsive-16by9"><iframe src="https://www.youtube.com/embed/' + splited[1] + '" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe></span>'
                            }
                    }else{
                        thumbnail = '<span class="embed-responsive embed-responsive-16by9"><iframe src="https://www.youtube.com/embed/' + url.pathname + '" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe></span>';
                    }
                }

        json_metadata = metadata;
        let category = metadata.category;
        let exturl = metadata.url;
        if (category === undefined) { category = "dlike"; } else {category = metadata.category;}
        let steemTags = metadata.tags;
        let dlikeTags = steemTags.slice(1);
        let posttags = dlikeTags.map(function (meta) { if (meta) return '<a href="#">' + meta + ' </a>' });
        let title = res.title;
        let author = res.author;
        let profile_url = "/@" + author;
        let auth_img = "https://steemitimages.com/u/" + author + "/avatar";
        
        let post_description = metadata.body.replace(/<[\/]{0,1}(p)[^><]*>/ig,"");
        let ext_url = metadata.url;
        let pending_steem = res.pending_payout_value.substr(0, 4);

        //let post_body = $(post_description).text();

        let postbody;
        if(res.body && res.body != undefined){
        try {
        postbody = res.body;
        postbody = postbody.split(/\n\n#####\n\n/);
        postbody = postbody[1];
        //postbody = postbody.replace(/#([^\s]*)/g,'');
        //postbody = postbody.replace(/<(.|\n)*?>/g, '');
        }catch(err) {
        postbody = "";
        }
        }else{
        postbody = "";
        }
        //console.log(postbody);
        $('.mod-auth').html(author);
        $('.mod-title').html(title);
        $('.post-thumb-block').html(thumbnail);
        $('.mod-authThumb').attr("src", auth_img);
        $('.author-thumb-link').attr("href", profile_url);
        $('.mod-auth').attr("href", profile_url);
        $('.mod-tags').html(posttags);
        //$('.mod-post').html(postbody);
        //$('.post_link').html('<a href="' + ext_url + '" target="_blank">Source of shared link</a>');
        $('.pending_payout').html(pending_steem);

        let page_description = post_description.substr(0,70);

        $(".social-share-list").html('<li><a class="twitter" href="javascript:void(0);" onclick="popup(\'https://www.twitter.com/share?text='+page_description+'&url=https://dlike.io/post/@'+author+'/'+post_permlink+'&hashtags=dlike\')"><i class="fab fa-twitter"></i></a></li><li><a class="faceboox" href="javascript:void(0);" onclick="popup(\'https://www.facebook.com/share.php?u=https://dlike.io/post/'+author+'/'+post_permlink+'&title='+title+'\')"><i class="fab fa-facebook-f"></i></a></li><li><a class="linkdin" href="javascript:void(0);" onclick="popup(\'https://www.linkedin.com/shareArticle?mini=true&url=https://dlike.io/post/'+author+'/'+post_permlink+'&title='+title+'&sumary=dlike.io\')"><i class="fab fa-linkedin-in"></i></a></li>');

                    //check if voted
            steem.api.getActiveVotes(author, post_permlink, function(err, result) {
                //console.log(result);
                    if(result === Array) {
                        var voterList = result;
                    } else {
                        var voterList = [];
                    }
                    if(!(voterList === Array)) {
                        voterList = [];
                    }
                    var voterList = result;
                for (let j = 0; j < voterList.length; j++) {
                    if (voterList[j].voter == username) { 
                        $("#steem_vote_icon").css("color", "RED"); 
                        $('#steem_vote_icon').click(function(){return false;});
                        $('a').removeClass('up_steem');
                        $('#steem_vote_icon').hover(function() {toastr.error('hmm... Already Upvoted');})
                    }
                }                        
            });

            $.getJSON('https://scot-api.steem-engine.com/@'+author+'/'+post_permlink+'', function(data) {
                //console.log(data.DLIKER.pending_token);
                let pending_token = (data.DLIKER.pending_token)/1000;
                $("#pending_dliker").html(pending_token);
                let voters = data.DLIKER.active_votes;
                let netshare = data.DLIKER.vote_rshares;

                    if(voters === Array) {
                        var voterList = voters;
                    } else {
                        var voterList = [];
                    }
                    if(!(voters === Array)) {
                        var voterList = [];
                    }
                    var voterList = voters;
                for (let v = 0; v < voterList.length; v++) {
                    if(voterList[v].weight>0){
                        let vote_amt = ((voterList[v].rshares / netshare) * pending_token).toFixed(3);
                        let votePercent = ((voterList[v].percent / 10000) * 100);
                        votePercent = parseInt(votePercent);
                        let voter = voterList[v].voter;
                        if (v > 0) {
                            $('#se_token').css('cursor','pointer');
                        }
                        res["voterlist"] += '<li style="list-style:none;"><span style="color:#c51d24;"><a> @' + voter + '</a></span>&nbsp;<span>(' + votePercent + '%)</span>&nbsp;&nbsp;<span style="float:right;"><i>' + vote_amt + '</i></span></li>'; 
                    }    
                }
                $('#se_token').attr("data-content", res["voterlist"]);
            });
    });
    //comments
var refreashComments = function () {
    let comment = []    
    steem.api.getContentReplies(post_author, post_permlink, function(err, result) {
            //showMainComment(0, result);
            
            for (var i = 0; i < result.length; i++) {
            //function showMainComment(i, commentsArray) {
            //console.log(commentsArray.length);
            $comment = result[i];

            //console.log($comment);
            let metadata;
            if ($comment.json_metadata && $comment.json_metadata.length > 0){
                metadata = JSON.parse($comment.json_metadata);
            }
            if(metadata && metadata.community == "dlike"){
                let a_p = "https://dlike.io/@"+$comment.author;
                let $commentbody = $comment.body.replace(/<[\/]{0,1}(p)[^><]*>/ig,"");

                $(".cmt_section").append('<li class="comment">\n' +
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
    });
};
    refreashComments();
    //new-comment    
    $('.comt_bt').click(function () {
        if (username == null) 
        {
            toastr.error('hmm... You must be login!');
            return false;
        }
        if (!$.trim($('[name="cmt_body"]').val())) {
            toastr.error('It seems you forgot to post comment');
            return false;  
        }
    $(".comt_bt").html('commenting...');    
    let comment_body= $(".cmt").val(); 
    //console.log(comment_body); 
    let permlinkD = steem.formatter.commentPermlink(post_author, post_permlink);  
    var datac = {
            p_author: post_author,
            p_permlink: post_permlink,
            comt_body: comment_body,
            cmt_permlink: permlinkD
        };    
    $.ajax({
        type: "POST",
        url: "/helper/comment.php",
        data: datac,
            success: function(data) {
            console.log(data);
            try {
                var response = JSON.parse(data)
                    if(response.error == false) {
                        $(".cmt_section").html('');
                        $(".cmt").val('');
                        refreashComments();
                        toastr.success('Comment posted successfully!');
                        $(".comt_bt").html('Comment');
                    } else { 
                        toastr.error('There is some issue!'); 
                        $(".comt_bt").html('Comment');
                        return false;   
                    }
                } catch (err) {
                    toastr.error('Sorry. Server response is malformed.');
                }
            },
        });    
    });    

    // tip me
    var tipoptions = {
        target: '#tip-msg',
        url: '/helper/addtips.php',
        success: function() {
            $('#tipsubmit').hide();
            $('.tipratio').hide();
            $('.tipthnk').show();
        },
    }

    $('#tipsubmit').submit(function() {
        if (username == null) 
        {
            toastr.error('hmm... You must be login!');
            return false;
        }
        if (username == post_author) 
        {
            toastr.error('Sorry... You cant tip your own post!');
            return false;
        }
        if (thisuser !='PRO') {
            $("#prouser").modal("show");
            return false;
        }

        $(this).ajaxSubmit(tipoptions)
        return !1 
    });
    var sTime = new Date().getTime();
    var countDown = 595 - directTime;

    function UpdateTime() {
        var cTime = new Date().getTime();
        var diff = cTime - sTime;
        var seconds = countDown - Math.floor(diff / 1000);
        if (seconds >= 0) {
            var minutes = Math.floor(seconds / 60);
            seconds -= minutes * 60;
            $("#minutes").text(minutes < 10 ? "0" + minutes : minutes);
            $("#seconds").text(seconds < 10 ? "0" + seconds : seconds);
            $(".tipratio").hide();
            $(".tipthnk").show();
        } else {
            $("#countdown").hide();
            $(".tipthnk").hide();
            $(".tipratio").show();
            $("#aftercount").show();

            clearInterval(counter);
        }
    }
    UpdateTime();
    var counter = setInterval(UpdateTime, 500);

    $('#aftercount').click(function () {
     location.reload(true); 
 });
    $('.prouser').click(function () {
     window.open("/help","_self");
 });  

//steem-upvote
$('.up_steem').click(function () {
    $("#vote_author").val(post_author);
    $("#vote_permlink").val(post_permlink);
    $("#upvoteModal").modal("show");
});   