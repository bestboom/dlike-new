<footer class="footer" style="background: #0C090D;">
<div class="footer-upper-section" style="padding: 50px 0 30px !important;"><div class="container"><div class="row"><div class="col-lg-3 col-md-4"><div class="footer-logo"> <a href="#"> <img src="/images/logo.png" alt="img" class="img-responsive"/> </a></div></div><div class="col-lg-3 col-md-4"><div class="footer-info-list"><h4>Learn</h4><ul><li><a href="/about/terms">Terms of Use</a></li><li><a href="/about/privacy">Privacy Policy</a></li><li><a href="/docs/dlike-paper.pdf" target="_blank">Whitepaper</a></li></ul></div></div><div class="col-lg-3 col-md-4"><div class="footer-info-list"><h4>Help</h4><ul><li><a href="/about/help">FAQ</a></li><li><a href="/about/how-it-works">How It Works</a></li></ul></div></div><div class="col-lg-3 col-md-4"><div class="footer-info-list"><h4>COMMUNICATIONS</h4><ul class="social-style-two"><li><a href="https://discord.gg/JYSkBFk"><i class="fab fa-discord"></i></a></li><li><a href="https://twitter.com/dlike_io"><i class="fab fa-twitter"></i></a></li><li><a href="https://t.me/dlike_io"><i class="fab fa-telegram"></i></a></li><li><a href="https://facebook.com/dlike.io"><i class="fab fa-facebook"></i></a></li></ul></div></div></div></div></div>
<div class="footer-bottom" style="padding: 25px 0 50px 0px !important;"><div class="container"><div class="footer-bottom-wrap" style="justify-content: center;font-size: 13px;"><div class="copyright-text">&copy; 2018 <a href="/">DLIKE</a>. A social sharing dApp by BlockTalk Solutions.</div></div></div></div>
</footer>
<script>let dlike_user_img="<?php echo $dlk_profile_img; ?>";let mainContractAddress="<?php echo $tron_contract; ?>";</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="/js/toaster.js"></script><script src="/js/loader.js"></script>
<?php if(basename($_SERVER['PHP_SELF'])=='dlikeshare.php'){ ?><script src="/js/dlikeshare.js"></script><? } ?>
<?php if(basename($_SERVER['PHP_SELF'])=='editDlikePost.php'){?><script src="/js/editdlikepost.js"></script><? }?>
<?php if(basename($_SERVER['PHP_SELF'])=='dlike_staking.php'){?><script src="/js/staking.js"></script><?} ?>
<?php if(basename($_SERVER['PHP_SELF'])=='dlike_wallet.php'){?><script src="/js/wallet.js"></script><?} ?>
<?php if(basename($_SERVER['PHP_SELF']) == 'share.php'){ ?><script src="https://cdn.jsdelivr.net/npm/steemconnect"></script><script src="/js/steemconnect.js"></script><script src="/js/steemshare.js"></script><? } ?>
<?php if(basename($_SERVER['PHP_SELF']) == 'editDetails.php'){ ?><script src="https://cdn.jsdelivr.net/npm/steemconnect"></script><script src="/js/steemconnect.js"><? } ?>
<?php if(basename($_SERVER['PHP_SELF']) == 'welcome2.php' || basename($_SERVER['PHP_SELF']) == 'welcome.php'){ ?><script src="/js/signup.js"></script><script src="https://cdn.jsdelivr.net/npm/steemconnect"></script><script src="https://unpkg.com/dsteem@0.10.1/dist/dsteem.js"></script><script src="/js/dlike_account.js"><? } ?><?php if(basename($_SERVER['PHP_SELF']) == 'steemposts.php') { ?><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script><script src="/js/posts.js"></script><script src="https://momentjs.com/downloads/moment.min.js"></script><script src="https://cdn.jsdelivr.net/npm/steemconnect"></script><script src="https://unpkg.com/dsteem@0.10.1/dist/dsteem.js"></script><script src="https://cdn.jsdelivr.net/npm/steem/dist/steem.min.js"></script><script src="/js/steemconnect.js"></script><? } ?>
<?php if(basename($_SERVER['PHP_SELF']) == 'post.php') { ?><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script><script src="https://momentjs.com/downloads/moment.min.js"></script><script src="https://cdn.jsdelivr.net/npm/steemconnect"></script><script src="https://unpkg.com/dsteem@0.10.1/dist/dsteem.js"></script><script src="https://cdn.jsdelivr.net/npm/steem/dist/steem.min.js"></script><script src="/js/steemconnect.js"></script><script src="/js/post_page.js"></script><?}?>
<?php if(basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == 'dlike_posts.php' || basename($_SERVER['PHP_SELF']) == 'dlike_trending.php' || basename($_SERVER['PHP_SELF']) == 'dlike_post.php' || basename($_SERVER['PHP_SELF']) == 'dlike_profile.php' || basename($_SERVER['PHP_SELF']) == 'dlike_tags.php' || basename($_SERVER['PHP_SELF']) == 'dlike_category.php'){ ?><script src="/js/solve.js"></script><? } ?>
<?php if(basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == 'dlike_posts.php' || basename($_SERVER['PHP_SELF']) == 'trending.php' || basename($_SERVER['PHP_SELF']) == 'steemposts.php'){ ?><script src="/js/trending.js"></script><? } ?>
<?php if(basename($_SERVER['PHP_SELF']) == 'dlike_profile.php'){ ?><script src="/js/profile.js"></script><? } ?><script src="/assets/js/bootstrap.min.js"></script><script>$(".my_img #p_img").on('error', function() {$(this).attr("src", "https://i.postimg.cc/rwbTkssy/dlike-user-profile.png");});</script><script async src="https://appsha1.cointraffic.io//js/?wkey=hLMQzDKQgG"></script>
</body>
</html>