if ($.cookie("dlike_username") != null) {var dlike_username  = $.cookie("dlike_username");console.log(dlike_username);$("#user_img").attr("src", dlike_user_img).show();}
function openNav(){document.getElementById("mySidenav").style.width="250px"}function closeNav(){document.getElementById("mySidenav").style.width="0"}function popup(e){var n=(screen.width-700)/2,t="width=700, height=400";return t+=", top="+(screen.height-400)/2+", left="+n,t+=", directories=no",t+=", location=no",t+=", menubar=no",t+=", resizable=no",t+=", scrollbars=no",t+=", status=no",t+=", toolbar=no",newwin=window.open(e,"windowname5",t),window.focus&&newwin.focus(),!1}$(".subscribe").click(function(e){e.preventDefault();let n=$("#subscribe_field").val();return""==$.trim($("#subscribe_field").val())?(toastr.error("phew... Please enter Email Address"),!1):isValidEmailAddress(n)?void toastr.success("Thanks for subscribing"):(toastr.error("phew... Not a valid Email Address"),!1)});
$('#logout_btn').click(function() {
    if ($.cookie("dlike_username")) { $.removeCookie('dlike_username', { path: '/' }); document.location.href = '/';}
    if ($.cookie("username")) {document.location.href = '/steemlogin/steem_logout.php';}
});