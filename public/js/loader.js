if ($.cookie("dlike_username") != null) {var dlike_username  = $.cookie("dlike_username");$("#user_img").attr("src", dlike_user_img).show();}if ($.cookie("username") != null) {var username  = $.cookie("username");$("#user_img").attr("src", "https://steemitimages.com/u/" + username + "/avatar").show();}
function openNav(){document.getElementById("mySidenav").style.width="250px"}function closeNav(){document.getElementById("mySidenav").style.width="0"}function popup(e){var n=(screen.width-700)/2,t="width=700, height=400";return t+=", top="+(screen.height-400)/2+", left="+n,t+=", directories=no",t+=", location=no",t+=", menubar=no",t+=", resizable=no",t+=", scrollbars=no",t+=", status=no",t+=", toolbar=no",newwin=window.open(e,"windowname5",t),window.focus&&newwin.focus(),!1}
$('#logout_btn').click(function(){if ($.cookie("dlike_username")) { $.removeCookie('dlike_username', { path: '/' }); document.location.href = '/';}if ($.cookie("username")) {document.location.href = '/steemlogin/steem_logout.php';}});
document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelectorAll('.my_img').forEach(
        function(img){
            console.log('avatar img is');
            console.log(img);
            img.onerror = function(){
                this.src='https://i.postimg.cc/rwbTkssy/dlike-user-profile.png';
            };
            }
            );
            document.querySelectorAll('.card-img-top').forEach(
                function(img){
                    console.log('post img is');
                    console.log(img);
                    img.onerror = function(){
                        this.src='https://dlike.io/images/default-img.png';
                    };
                    }
                    );    
        }
        );