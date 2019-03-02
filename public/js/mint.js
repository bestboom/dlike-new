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
    	let url = $("#url_field").val();
    	if(url == '') { $("#url_field").css("border-color", "RED"); } else {

    	_hide($add_data_f);
        _show($loader);

        let verifyUrl = getDomain(url);
        	if(isValidURL(url)){ 
        		if(verifyUrl.match(/steemit.com/g)) { 
        		alert('steem url not allowed'); } else{ _fetch("helper/index.php",url); return; }
        	}
    	}
    });    
	function _fetch(apiUrl,webUrl) {
        $.post(apiUrl,{url:webUrl},function(response){
            console.log(response);
            
            let res = JSON.parse(response);
            window.location.replace("editDetails.php?url="+encodeURIComponent(res.url)+"&title="+encodeURIComponent(res.title)+"&imgUrl="+encodeURIComponent(res.imgUrl)+"&details="+encodeURIComponent(res.des));
            console.log("Response array: "+res.imgUrl);

        });
    }
	function isValidURL(url){
        var RegExp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        if(RegExp.test(url)) {
            return true;
        } else {
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
                                    $.ajax({
                type: "POST",
                url: "template/modals/likes.php",
                data: datat,
                success: function(data) {
                }
                            }
                        } catch (err) {
                            alert('Sorry. Server response is malformed.')
                        }
                    }
            });

    $("#author_rate").val(authorname);
    $("#permlink_rate").val(mypermlink);
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
$('.upme').click(function() {
    let upvoteValue = $('#rs-range-line').val();
    alert(upvoteValue)
});
