<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dlike - Share To Get Rewarded</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Dlike is a blockchain based dApp where you share links from your own blog articles or any useful link that is informative for community and get rewarded if community likes your links with steem upvotes.">
  <link rel='favicon icon' type=image/x-icon href=images/favicon.ico />
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="/assets/css/themify-icons.css">
  <link rel="stylesheet" href="/assets/css/slick.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">
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
</div>  
<div class="latest-post-section">
        <div class="container">  
<?php
$sql1 = "SELECT * FROM latestnews ORDER BY id DESC LIMIT 48";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
		while($row1 = $result1->fetch_assoc()) {
			//$json_metadata = json_decode($row1['json_metadata'],true);

				//$imgsrc = $json_metadata['image'];
				//$permlink = $row1['permlink'];
				//$username = $row1['username'];
				echo $title = $row1['title']."<br>";
				
				
				
		}
	}
?>	
</div></div>
    <footer class="footer">
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-in">
                    <div class="trade-volume-block">
                        <ul><li><span>Made with <i class="fas fa-heart"></i> By Dlike</span></li></ul>
                    </div>
                    <div class="row copyright-text">
                        <div><a href="/"><img src="/images/logo.png" alt="img" class="img-responsive"/></a></div>&nbsp;<div><p>  © 2019 <a href="#">DLike</a>. All Rights Reserved</p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/js/mint.js"></script>
    <script src="https://cdn.steemjs.com/lib/latest/steem.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/steemconnect@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="/js/posts.js"></script>
    <script src="/js/steemconnect.js"></script>
</body>
</html>