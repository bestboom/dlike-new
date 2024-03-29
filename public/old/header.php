<?php include('../includes/config.php'); ?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(basename($_SERVER['PHP_SELF']) == 'post.php'){ ?><title><?php echo $og_title; ?></title>
<meta name="description" content="<?php echo $og_description; ?>" />
<meta property="og:url" content="<?php echo $og_url; ?>" />
<meta property="og:title" content="<?php echo $og_title; ?>" />
<meta property="og:description" content="<?php echo $og_description; ?>" />
<meta property="og:image" content="<?php echo $og_image; ?>" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $og_title; ?>">
<meta name="twitter:description" content="<?php echo $og_description; ?>">
<meta name="twitter:image" content="<?php echo $og_image; ?>">
<meta name="twitter:domain" content="<?php echo $og_url; ?>">
<link rel="canonical" href="<?php echo $og_url; ?>" />
<? } else if(basename($_SERVER['PHP_SELF']) == 'profile.php'){ ?>  
<title><?php echo ucfirst($prof_user).' (@'.$prof_user.')'; ?> Posts Shared on DLIKE</title>
<meta name="description" content="The latest posts shared by <?php echo ucfirst($prof_user).' (@'.$prof_user.')'; ?> on DLIKE. An informative face of internet to share and get rewarded like <?php echo ucfirst($prof_user); ?>.">
<? } else { ?><title>DLIKE - Share To Get Rewarded</title>
<meta name="description" content="Dlike is a blockchain based dApp where you share links from your own blog articles or any useful link that is informative for community and get rewarded if community likes your links with steem upvotes.">
<meta property="og:url" content="https://dlike.io" />
<meta property="og:title" content="Dlike - Share To Get Rewarded" />
<meta property="og:description" content="Dlike is a blockchain based dApp where you share links from your own blog articles or any useful link that is informative for community and get rewarded if community likes your links with steem upvotes." />
<meta property="og:image" content="/images/dlike-main.jpg" />
<? } ?>
<link rel="apple-touch-icon" sizes="180x180" href="https://dlike.io/images/favicons/apple-touch-icon.png?v=kPvWrWRLXe"><link rel="icon" type="image/png" sizes="32x32" href="https://dlike.io/images/favicons/favicon-32x32.png?v=kPvWrWRLXe"><link rel="icon" type="image/png" sizes="16x16" href="https://dlike.io/images/favicons/favicon-16x16.png?v=kPvWrWRLXe"><link rel="manifest" href="https://dlike.io/images/favicons/site.webmanifest?v=kPvWrWRLXe"><link rel="shortcut icon" href="https://dlike.io/images/favicons/favicon.ico?v=kPvWrWRLXe"><meta name="apple-mobile-web-app-title" content="DLIKE"><meta name="application-name" content="DLIKE"><meta name="msapplication-TileColor" content="#2d89ef"><meta name="msapplication-config" content="https://dlike.io/images/favicons/browserconfig.xml?v=kPvWrWRLXe"><meta name="theme-color" content="#ffffff">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"><link rel="stylesheet" href="/css/style.css"><link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
</head><body>
<div id="mySidenav" class="sidenav">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<?php if (isset($_COOKIE['username']) || !empty($_COOKIE['username'])) { ?><a href="/old/wallet">Wallet</a>
<a href="/dliker">DLIKER</a> <? } else {} ?>        
<a href="https://dex.dlike.io">DEX</a>
<a href="/old/rewards">Reward Pool</a>
<a href="/old/staking">Staking</a>
<a href="/old/explorer">Explorer</a>
<a href="/about/help">FAQ</a>
<?php if (isset($_COOKIE['dlike_username']) || !empty($_COOKIE['dlike_username']) || isset($_COOKIE['username']) || !empty($_COOKIE['username'])) { echo '<a id="logout_btn">Logout</a>';} else { } ?><br>
<a href="/docs/dlike-paper.pdf">Whitepaper</a>
</div>
<div class="banner-block"><nav class="navbar main-nav navbar-expand-lg"><div class="container">
    <a class="navbar-brand" href="/"><img class="navbar-logo" src="/images/logo.png" alt="DLIKE"/></a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto"><li class="nav-item top_nav_li">
            <div class="row top_nav"><div class="col-md-3 col-2"><?php if (isset($_COOKIE['dlike_username']) || $_COOKIE['dlike_username']) { ?><button onclick="window.location.href='/profile/<?php echo $_COOKIE['dlike_username']; ?>';" type="button" class="btn btn-default btn-circle-it btn-lg custom_btn_icon search_btn_hover"><span class="img_profile"><img src="/images/user.png" alt="<? echo $_COOKIE['dlike_username']; ?>" title="<? echo $_COOKIE['dlike_username']; ?>" id="user_img" class="rounded-circle img-fluid prof_img_nav"></span></button>
                    <? } elseif (isset($_COOKIE['username']) || $_COOKIE['username'])  { ?><button onclick="window.open('https://steemit.com/@<? echo $_COOKIE['username']; ?>', '_blank');" type="button" class="btn btn-default btn-circle-it btn-lg custom_btn_icon search_btn_hover"><span class="img_profile"><img src="/images/user.png" alt="<? echo $_COOKIE['username']; ?>" title="<? echo $_COOKIE['username']; ?>" id="user_img" class="rounded-circle img-fluid prof_img_nav"></span>
                    </button><? } else { ?><button onclick="window.location.href='/welcome';" type="button" class="btn btn-default btn-circle-it btn-lg custom_btn_icon search_btn_hover"><i class="fas fa-user"></i></button><? } ?></div>
                <div class="col-md-4 col-2"><button onclick="window.location.href='/share';" id="btn_share" type="button" class="btn btn-default btn-circle-it btn-lg custom_btn_icon edit_btn_hover"><i class="fa fa-pencil-alt"></i></button></div>
                <div class="col-md-4 col-2" style="margin-top: 5px;"><span class="nav_sticks" onclick="openNav()">&#9776;</span></div>
            </div>
        </li></ul>
    </div>
</div></nav><!-- main-nav-block -->
<?php if(isset($_COOKIE['dlike_username']) || $_COOKIE['dlike_username']){$dlk_user=$_COOKIE['dlike_username'];$sql_Z=$conn->query("SELECT * FROM dlikeaccounts where username = '$dlk_user'");$row_Z=$sql_Z->fetch_assoc();$dlk_profile_img=$row_Z["profile_pic"];}?>