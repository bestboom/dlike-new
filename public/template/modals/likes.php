<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


        echo $author =  '<script>var authorname;</script>';
        echo $permlink =  $_POST['rated_permlink'];


        echo $author =  $_GET['rated_author'];
        echo $permlink =  $_GET['rated_permlink'];
        
        $sql = "SELECT likes, rating FROM PostsLikes WHERE author = '$author' AND permlink = '$permlink'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $likes = $row['likes'];
                $rating = $row['rating'];

        $avg_star = round($rating/$likes, 2); $star_score = round($avg_star * 20, 2); $set_star = 'width:'.$star_score.'%'; ?>
?>
<div class="dvd-account-title">
    <h3>Do You Recomend this Share?</h3>
    <p><span>Total Votes:  <?php echo $likes; ?>  <div class="star-ratings-sprite">Ratings: <span style="<?php echo $set_star; ?>" class="star-ratings-sprite-rating"></span></div> </span></p>
</div>  
<? }
} 

?>
<div class="md-account-banner">
    <div class="row justify-content-center">
        <div style="height:60px;width:470px;"></div>
    </div>
</div>                    
                <div class="dvd-account-content">
                    <form action="helper/solve.php" method="post" id="logsubmit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row justify-content-center form-group">
                                <span id="capt"><?php echo solvemedia_get_html("pJG21ZGjcE3uBoChKLz3AFUQTeHgcEir", null, true); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="user_label"><b>Enter Some username </b></label>
                                <input type="text" class="form-control" name="likes_user" id="likes_name" value="">
                            </div>
                            <div class="form-group">
                                <label><b>Rate this post if you want</b></label>
                                <input type="hidden" name="ratingz" id="myRatingz" value="0" />
                                <input type="hidden" name="rated_author" id="author_rate" value="" />
                                <input type="hidden" name="rated_permlink" id="permlink_rate" value="" />
                                <div class="stars">
                                    <input class="star star-5" id="star-5" type="radio" name="star" onclick="postToControll();" value="5" />
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" id="star-4" type="radio" name="star" onclick="postToControll();" value="4" />
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" id="star-3" type="radio" name="star" onclick="postToControll();" value="3" />
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" id="star-2" type="radio" name="star" onclick="postToControll();" value="2" />
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" id="star-1" type="radio" name="star" onclick="postToControll();" value="1" />
                                    <label class="star star-1" for="star-1"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form btn-sub">
                    	<div id="output-msg"></div>
                    	<button type="submit" class="btn btn-default" id="upvote">UPVOTE</button>
                    </div>
                	</form>
                    </div>
                    <div class="modal-likes">
                      	<h3>Rules For Recomendation</h3>
                    	<div class="row">
                            <ul>
                                <li class="letter"><i class="fas fa-exclamation-triangle"></i>  Self promotion not allowed</li>
                                <li class="letter"><i class="fas fa-exclamation-triangle"></i>  Make sure to upvote quality posts and do not promote spam</li>
                            </ul>
                        </div>
                    </div>
                </div>
