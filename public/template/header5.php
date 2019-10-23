<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if(basename($_SERVER['PHP_SELF']) == 'post.php'){ ?>    
        <title><?php echo $og_title; ?></title>
        <meta name="description" content="<?php echo trim(preg_replace("~<blockquote(.*?)>(.*)</blockquote>~si","",' '.$og_description.' ')); ?>">
        <meta property="og:url" content="<?php echo $og_url; ?>" />
        <meta property="og:title" content="<?php echo $og_title; ?>" />
        <meta property="og:description" content="<?php echo trim(preg_replace("~<blockquote(.*?)>(.*)</blockquote>~si","",' '.$og_description.' ')); ?>" />
        <meta property="og:image" content="<?php echo $og_image; ?>" />
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo $og_title; ?>">
        <meta name="twitter:description" content="<?php echo trim(preg_replace("~<blockquote(.*?)>(.*)</blockquote>~si","",' '.$og_description.' ')); ?>">
        <meta name="twitter:image" content="<?php echo $og_image; ?>">
        <meta name="twitter:domain" content="<?php echo $og_url; ?>">
        <link rel="canonical" href="<?php echo $og_url; ?>" />

    <? } 
    else if(basename($_SERVER['PHP_SELF']) == 'profile.php'){ ?>  
        <title><?php echo ucfirst($prof_user).' (@'.$prof_user.')'; ?> Posts Shared on DLIKE</title>
        <meta name="description" content="The latest posts shared by <?php echo ucfirst($prof_user).' (@'.$prof_user.')'; ?> on DLIKE. An informative face of internet to share and get rewarded like <?php echo ucfirst($prof_user); ?>.">
    <? } else { ?>    
        <title>DLIKE - Share To Get Rewarded</title>
        <meta name="description" content="Dlike is a blockchain based dApp where you share links from your own blog articles or any useful link that is informative for community and get rewarded if community likes your links with steem upvotes.">
        <!--Facebook Meta Tags -->
        <meta property="og:url" content="https://dlike.io" />
        <meta property="og:title" content="Dlike - Share To Get Rewarded" />
        <meta property="og:description" content="Dlike is a blockchain based dApp where you share links from your own blog articles or any useful link that is informative for community and get rewarded if community likes your links with steem upvotes." />
        <meta property="og:image" content="/images/dlike-main.jpg" />
        <!--End Facebook Meta Tags-->
    <? } ?>
        <link rel='favicon icon' type=image/x-icon href=/images/favicon.ico />
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="/assets/css/themify-icons.css">
        <link rel="stylesheet" href="/assets/css/slick.css">
        <link rel="stylesheet" href="/css/style3.css">
        <link rel="stylesheet" href="/css/responsive.css">
<?php if(basename($_SERVER['PHP_SELF']) == 'welcome.php'){ ?> 
        <link rel="stylesheet" href="/css/intlTelInput.css">
<? } ?> 
</head>
<body>
<script language="javascript" data-spot_id_top="GDYU9ITE33L7W" data-site_id_top="IN0CPFCKPXSN5" src="//coinad.com/ads/show/topbar.js"></script> 
    <div id="mySidenav" class="sidenav" style="    z-index: 222222;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="/wallet">Wallet</a>
        <a href="/dliker">DLIKER</a>
        <a href="/rewards">Reward Pool</a>
        <a href="/staking">Staking</a>
        <a href="/explorer">Explorer</a>
        <a href="/help">FAQ</a>
        <?php if (isset($_COOKIE['username']) || !empty($_COOKIE['username'])) { echo '<a href="javascript:void(0)" class="logout_btn">Logout</a>';} else { } ?>
        <br>
        <a href="/token">Token</a>
        <a href="/docs/dlike-paper.pdf">Whitepaper</a>
    </div>
    <div class="banner-block">
        <nav class="navbar main-nav navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img class="navbar-logo" src="/images/logo.png" alt="Dlike"/>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item" style="padding-top: 4px;">
                            <div class="row" style="margin: 0px;">
                                <div class="col-md-3 col-2">
                                    <?php if (!isset($_COOKIE['username']) || !$_COOKIE['username']) { ?>
                                    <button onclick="window.location.href='/welcome';" type="button" class="btn btn-default btn-circle-it btn-lg custom_btn_icon search_btn_hover"><i class="fas fa-user"></i>
                                    </button>
                                    <? } else { ?>
                                    <button onclick="window.location.href='/@<? echo $_COOKIE['username']; ?>';" type="button" class="btn btn-default btn-circle-it btn-lg custom_btn_icon search_btn_hover"><span class="img_profile"><img src="/images/user.png" alt="<? echo $_COOKIE['username']; ?>" title="<? echo $_COOKIE['username']; ?>" id="user_img" class="rounded-circle img-fluid" style="background: #fff;margin-top: -6px;"></span>
                                    </button><? } ?>
                                </div>
                                <div class="col-md-4 col-2">
                                    <button onclick="window.location.href='/share';" id="btn_share" type="button" class="btn btn-default btn-circle-it btn-lg custom_btn_icon edit_btn_hover"><i class="fa fa-pencil-alt"></i>
                                    </button>
                                </div>
                                <div class="col-md-4 col-2" style="margin-top: 5px;">
                                    <span class="nav_sticks" onclick="openNav()">&#9776;</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav><!-- main-nav-block -->