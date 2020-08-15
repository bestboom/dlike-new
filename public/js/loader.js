if ($.cookie("dlike_username") != null) {var dlike_username  = $.cookie("dlike_username");console.log(dlike_username);$("#user_img").attr("src", dlike_user_img).show();}
function openNav(){document.getElementById("mySidenav").style.width="250px"}function closeNav(){document.getElementById("mySidenav").style.width="0"}function popup(e){var n=(screen.width-700)/2,t="width=700, height=400";return t+=", top="+(screen.height-400)/2+", left="+n,t+=", directories=no",t+=", location=no",t+=", menubar=no",t+=", resizable=no",t+=", scrollbars=no",t+=", status=no",t+=", toolbar=no",newwin=window.open(e,"windowname5",t),window.focus&&newwin.focus(),!1}$(".subscribe").click(function(e){e.preventDefault();let n=$("#subscribe_field").val();return""==$.trim($("#subscribe_field").val())?(toastr.error("phew... Please enter Email Address"),!1):isValidEmailAddress(n)?void toastr.success("Thanks for subscribing"):(toastr.error("phew... Not a valid Email Address"),!1)});
$('#logout_btn').click(function() {
    if ($.cookie("dlike_username")) { $.removeCookie('dlike_username', { path: '/' }); document.location.href = '/';}
    if ($.cookie("username")) {document.location.href = '/steemlogin/steem_logout.php';}
});
$(document).ready(function () {
    var hidWidth;var scrollBarWidths_2 = 40;
    var widthOfList_2 = function(){var itemsWidth = 0;
        $('.list-2 a').each(function(){var itemWidth = $(this).outerWidth();itemsWidth+=itemWidth;});
        return itemsWidth;};
    var widthOfHidden_2 = function(){return (($('.wrapper').outerWidth())-widthOfList_2()-getLeftPosi_2())-scrollBarWidths_2;};
    var getLeftPosi_2 = function(){return $('.list-2').position().left;};
    var reAdjust_2 = function(){
        if (($('.wrapper').outerWidth()) < widthOfList_2()) {$('.scroller-right-2').show().css('display', 'flex');}else {}
        if (getLeftPosi_2()<0) {$('.scroller-left-2').show().css('display', 'flex');
        }else {$('.item').animate({left:"-="+getLeftPosi_2()+"px"},'slow');}
    }
    reAdjust_2();
    $(window).on('resize',function(e){reAdjust_2();});
    $('.scroller-right-2').click(function() {$('.scroller-left-2').fadeIn('slow');
        if(getLeftPosi_2() < -672){$('.scroller-right-2').fadeOut('slow');}
        $('.list-2').animate({left:"+="+"-112px"},'slow',function(){});
    });
    $('.scroller-left-2').click(function() {
        $('.scroller-right-2').fadeIn('slow');$('.scroller-left-2').fadeOut('slow');
        $('.list-2').animate({left:"-="+getLeftPosi_2()+"px"},'slow',function(){});
    });
});