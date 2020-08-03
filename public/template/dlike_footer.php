<div class="colto-section" style="padding: 35px 0;"><div class="container"><div class="colto-content-wrap">
<div class="colto-content"><h3>Share To Get Rewarded</h3><p>DLIKE - An Informative Face of Internet</p></div>
<div class="colto-btn-group" style="display: block;"><?php if(isset($_COOKIE['username']) && !empty($_COOKIE['username'])) { ?><input type="email" placeholder="Email To Subscribe" id="subscribe_field" style="padding: 15px 40px;border-radius: 5px;margin-right: 10px;"> <button class="btn callto-btn subscribe" />Subscribe</button> <? } else { ?><button class="btn callto-btn" onclick="window.open('/welcome', '_self');" />Log In</button><span>or</span><button class="btn callto-btn" onclick="window.open('/welcome', '_self');" />Create Account</button> <? } ?></div>
</div></div></div>
<footer class="footer" style="background: #0C090D;">
<div class="footer-upper-section" style="padding: 50px 0 30px !important;"><div class="container"><div class="row"><div class="col-lg-3 col-md-4"><div class="footer-logo"> <a href="#"> <img src="/images/logo.png" alt="img" class="img-responsive"/> </a></div></div><div class="col-lg-3 col-md-4"><div class="footer-info-list"><h4>Learn</h4><ul><li><a href="/terms">Terms of Use</a></li><li><a href="/privacy">Privacy Policy</a></li><li><a href="/docs/dlike-paper.pdf" target="_blank">Whitepaper</a></li></ul></div></div><div class="col-lg-3 col-md-4"><div class="footer-info-list"><h4>Help</h4><ul><li><a href="/help">FAQ</a></li><li><a href="/how-it-works">How It Works</a></li></ul></div></div><div class="col-lg-3 col-md-4"><div class="footer-info-list"><h4>COMMUNICATIONS</h4><ul class="social-style-two"><li><a href="https://discord.gg/JYSkBFk"><i class="fab fa-discord"></i></a></li><li><a href="https://twitter.com/dlike_io"><i class="fab fa-twitter"></i></a></li><li><a href="https://t.me/dlike_io"><i class="fab fa-telegram"></i></a></li><li><a href="https://facebook.com/dlike.io"><i class="fab fa-facebook"></i></a></li></ul></div></div></div></div></div>
<div class="footer-bottom" style="padding: 25px 0 50px 0px !important;"><div class="container"><div class="footer-bottom-wrap" style="justify-content: center;font-size: 13px;"><div class="copyright-text">&copy; 2018 <a href="/">DLIKE</a>. A social sharing dApp by BlockTalk Solutions.</div></div></div></div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="/js/toaster.js"></script>
<?php if(basename($_SERVER['PHP_SELF']) == 'welcome2.php'){ ?><script src="/js/signup.js"></script><? } ?> 
<script>
if ($.cookie("dlike_username") != null) {var dlike_username  = $.cookie("dlike_username");console.log(dlike_username);$("#user_img").attr("src", "<?php echo $dlk_profile_img; ?>").show();}
let mainContractAddress = "TD2YUZKn6oQnytWEWM38sMwgABou2RYa8M";
function openNav(){document.getElementById("mySidenav").style.width="250px"}function closeNav(){document.getElementById("mySidenav").style.width="0"}function popup(e){var n=(screen.width-700)/2,t="width=700, height=400";return t+=", top="+(screen.height-400)/2+", left="+n,t+=", directories=no",t+=", location=no",t+=", menubar=no",t+=", resizable=no",t+=", scrollbars=no",t+=", status=no",t+=", toolbar=no",newwin=window.open(e,"windowname5",t),window.focus&&newwin.focus(),!1}$(".subscribe").click(function(e){e.preventDefault();let n=$("#subscribe_field").val();return""==$.trim($("#subscribe_field").val())?(toastr.error("phew... Please enter Email Address"),!1):isValidEmailAddress(n)?void toastr.success("Thanks for subscribing"):(toastr.error("phew... Not a valid Email Address"),!1)});
$('#logout_btn').click(function() {
    if ($.cookie("dlike_username")) { $.removeCookie('dlike_username', { path: '/' }); document.location.href = '/';}
    if ($.cookie("username")) {document.location.href = '/steemlogin/steem_logout.php';}
});
</script>     
</body>
</html>