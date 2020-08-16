<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(basename($_SERVER['PHP_SELF']) == 'post.php'){ ?>    
  <title><?php echo $og_title; ?></title>
  <meta name="description" content="<?php echo trim(preg_replace("~<blockquote(.*?)>(.*)</blockquote>~si","",' '.$og_description.' ')); ?>">
  <!--Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo $og_url; ?>" />
    <meta property="og:title" content="<?php echo $og_title; ?>" />
    <meta property="og:description" content="<?php echo trim(preg_replace("~<blockquote(.*?)>(.*)</blockquote>~si","",' '.$og_description.' ')); ?>" />
    <meta property="og:image" content="<?php echo $og_image; ?>" />
<!--End Facebook Meta Tags-->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $og_title; ?>">
    <meta name="twitter:description" content="<?php echo trim(preg_replace("~<blockquote(.*?)>(.*)</blockquote>~si","",' '.$og_description.' ')); ?>">
    <meta name="twitter:image" content="<?php echo $og_image; ?>">
    <meta name="twitter:domain" content="<?php echo $og_url; ?>">
    <link rel="canonical" href="<?php echo $og_url; ?>" />
<?php } else { ?>
      <title>Dlike - Share To Get Rewarded</title>
  <meta name="description" content="Dlike is a blockchain based dApp where you share links from your own blog articles or any useful link that is informative for community and get rewarded if community likes your links with steem upvotes.">
  <!--Facebook Meta Tags -->
    <meta property="og:url" content="https://dlike.io" />
    <meta property="og:title" content="Dlike - Share To Get Rewarded" />
    <meta property="og:description" content="Dlike." />
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
</head>
<body>
<div id="mySidenav" class="sidenav" style="    z-index: 222222;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="/wallet">Wallet</a>
    <a href="/help">FAQ</a>
    <a href="/staking">Staking</a>
    <a href="/explorer">Explorer</a>
    <?php if (isset($_COOKIE['username']) || $_COOKIE['username']) { echo '<a href="javascript:void(0)" class="logout_btn">Logout</a>';} ?>
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
                    <li class="nav-item button active">
                        <a class="btn nav-link log_link" href=""><span class="img_profile"><img src="" id="user_img"  style="display: none;" class="rounded-circle img-fluid my_img"></span><span id="user_log"> Login</span></a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="">

                            <button type="button" class="btn btn-default btn-circle btn-lg"><i class="fa fa-list"></i>
                            </button>-->

                            <div class="row">
                                <!--  
                                <div class="col-md-3 col-2">
                                      <button type="button" class="btn btn-default btn-circle btn-lg custom_btn_icon search_btn_hover"><i class="fa fa-search"></i>
                                      </button>
                                </div>
  -->
                                <!--<div class="col-md-3 col-2">
                                    <button type="button" class="btn btn-default btn-circle btn-lg custom_btn_icon search_btn_hover"><i class="fas fa-user"></i>
                                    </button>
                                </div> -->

                                <div class="col-md-4 col-2">
                                    <!-- <a href="/share" class="btn btn-default btn-circle btn-lg custom_btn_icon edit_btn_hover"><i class="fa fa-pencil-alt"></i></a>-->
                                    <button onclick="window.location.href='/share';" id="btn_share" type="button" class="btn btn-default btn-circle btn-lg custom_btn_icon edit_btn_hover"><i class="fa fa-pencil-alt"></i>
                                    </button>
                                </div>

                                <div class="col-md-4 col-2">
                                    <span style="font-size:30px;cursor:pointer;color: #fff;" onclick="openNav()">&#9776;</span>
                                </div>

                            </div>
                        <!-- </a> -->

                    </li>

                </ul>
            </div>
        </div>
    </nav><!-- main-nav-block -->