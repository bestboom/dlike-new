<div class="colto-section" style="padding: 35px 0;"><div class="container"><div class="colto-content-wrap">
<div class="colto-content"><h3>Share To Get Rewarded</h3><p>DLIKE - An Informative Face of Internet</p></div>
<div class="colto-btn-group" style="display: block;"><?php if(isset($_COOKIE['username']) && !empty($_COOKIE['username'])) { ?><input type="email" placeholder="Email To Subscribe" id="subscribe_field" style="padding: 15px 40px;border-radius: 5px;margin-right: 10px;"> <button class="btn callto-btn subscribe" />Subscribe</button> <? } else { ?><button class="btn callto-btn" onclick="window.open('/welcome', '_self');" />Log In</button><span>or</span><button class="btn callto-btn" onclick="window.open('/welcome', '_self');" />Create Account</button> <? } ?></div>
</div></div></div>
<footer class="footer" style="background: #0C090D;">
<div class="footer-upper-section" style="padding: 50px 0 30px !important;"><div class="container"><div class="row"><div class="col-lg-3 col-md-4"><div class="footer-logo"> <a href="#"> <img src="/images/logo.png" alt="img" class="img-responsive"/> </a></div></div><div class="col-lg-3 col-md-4"><div class="footer-info-list"><h4>Learn</h4><ul><li><a href="/terms">Terms of Use</a></li><li><a href="/privacy">Privacy Policy</a></li><li><a href="/docs/dlike-paper.pdf" target="_blank">Whitepaper</a></li></ul></div></div><div class="col-lg-3 col-md-4"><div class="footer-info-list"><h4>Help</h4><ul><li><a href="/help">FAQ</a></li><li><a href="/how-it-works">How It Works</a></li></ul></div></div><div class="col-lg-3 col-md-4"><div class="footer-info-list"><h4>COMMUNICATIONS</h4><ul class="social-style-two"><li><a href="https://discord.gg/JYSkBFk"><i class="fab fa-discord"></i></a></li><li><a href="https://twitter.com/dlike_io"><i class="fab fa-twitter"></i></a></li><li><a href="https://t.me/dlike_io"><i class="fab fa-telegram"></i></a></li><li><a href="https://facebook.com/dlike.io"><i class="fab fa-facebook"></i></a></li></ul></div></div></div></div></div>
<div class="footer-bottom" style="padding: 25px 0 50px 0px !important;"><div class="container"><div class="footer-bottom-wrap" style="justify-content: center;font-size: 13px;"><div class="copyright-text">&copy; 2018 <a href="/">DLIKE</a>. A social sharing dApp by BlockTalk Solutions.</div></div></div></div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/slick.min.js"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/steemconnect@latest"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="https://unpkg.com/dsteem@^0.10.1/dist/dsteem.js"></script>
<script src="https://cdn.jsdelivr.net/npm/steem/dist/steem.min.js"></script>
<script src="/js/steemconnect.js"></script>
<script src="/js/toaster.js"></script>
<script src="/js/mint.js"></script>
<?php if(basename($_SERVER['PHP_SELF']) == 'index.php') { ?> 
<script src="/js/posts.js"></script>
<? } ?>
<?php if(basename($_SERVER['PHP_SELF']) == 'welcome.php'){ ?> 
<script src="/js/intlTelInput.js?1562189064761"></script>
<script src="https://intl-tel-input.com/node_modules/intl-tel-input/build/js/intlTelInput.js?1562189064761"></script>
<script src="/js/signup.js"></script>
<? } ?> 
<script async src="https://appsha1.cointraffic.io//js/?wkey=hLMQzDKQgG"></script>
<script>
    function openNav(){document.getElementById("mySidenav").style.width="250px";}
    function closeNav(){document.getElementById("mySidenav").style.width="0";}
    function popup(e){var t=700;var n=400;var r=(screen.width-t)/2;var i=(screen.height-n)/2;var s="width="+t+", height="+n;s+=", top="+i+", left="+r;s+=", directories=no";s+=", location=no";s+=", menubar=no";s+=", resizable=no";s+=", scrollbars=no";s+=", status=no";s+=", toolbar=no";newwin=window.open(e,"windowname5",s);if(window.focus){newwin.focus()}return false};
    $('.subscribe').click(function(e){e.preventDefault();let subscribe_value=$("#subscribe_field").val();if($.trim($('#subscribe_field').val())==''){toastr.error('phew... Please enter Email Address');return false;} if(!isValidEmailAddress(subscribe_value)){toastr.error('phew... Not a valid Email Address');return false;} toastr.success('Thanks for subscribing');});
    $('body').popover({ selector: '[data-popover]', trigger: 'click hover', placement: 'auto', delay: {show: 50, hide: 400}});
</script>     
</body>
</html>