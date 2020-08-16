<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dlike - Earn By Sharing Your Article Links</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Dlike is a blockchain based dApp where you share links from your own blog articles or any useful link that is informative for community and get paid if community likes your links with steem upvotes.">
  <link rel='favicon icon' type=image/x-icon href=images/favicon.ico />
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="/assets/css/themify-icons.css">
  <link rel="stylesheet" href="/assets/css/slick.css">
  <link rel="stylesheet" href="/css/style2.css">
  <link rel="stylesheet" href="/css/responsive.css">
  
  <style>
/* Center the loader */
#loader {
  position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    margin: -60px 0 0 -60px;
    border: 7px solid #4147a1;
    border-radius: 50%;
    border-top: 7px solid #4147a1;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s ease-in-out infinite; 
    animation: spin 2s ease-in-out infinite;
  
      text-align: center;
    font-size: 22px;
    padding-top: 38px;

      background: #4147a1;
    color: #ffffff;
  
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}
    .myloader{display:none;}
    .latest-post-section{position:relative;}
</style>
</head>
<body>
  
  
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
                      <li class="nav-item"><a class="nav-link" href="/share.php">SHARE</a></li>
                      <li class="nav-item"><a class="nav-link" href="/explorer">Explorer</a></li>
                      <li class="nav-item"><a class="nav-link" href="/token">Token</a></li>
                      <li class="nav-item button active">
                          <a class="btn nav-link log_link" href="#"><span class="img_profile"><img src="" id="user_img"  style="display: none;" class="rounded-circle img-fluid my_img"></span><span id="user_log"> Login</span></a>
                      </li>
                    </ul>
                </div>
            </div>
        </nav><!-- main-nav-block -->
