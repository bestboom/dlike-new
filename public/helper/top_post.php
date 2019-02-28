<?php
$sqlt = "SELECT * FROM PostsLikes ORDER BY likes DESC LIMIT 1";
$result = $conn->query($sqlt);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $top_auth = $row["author"];
        $top_permlink = $row["permlink"];
        $top_likes = $row["likes"];
        $top_rating = $row["rating"];
        ?>
        <script>
            let topauthor = <?php echo json_encode($top_auth); ?>;
            let toppermlink = <?php echo json_encode($top_permlink); ?>;
        </script>
                <div class="col-md-6 post-thumb">
                    <a href="#"><img src="" alt="img" class="card-img-top2 img-fluid" id="top_img" style="display: none;"></a>
                </div>
                <div class="col-md-6 post-contnet-wrap">
                    <?php $top_likes; $top_rating; $avg_star = round($top_rating/$top_likes, 2); $star_score = round($avg_star * 20, 2); $set_star = 'width:'.$star_score.'%'; ?>

                    <div class="hov-wrap"><a class="hov-txt" data-toggle="modal" data-target="" data-permlink="' + toppermlink + '" data-author="' + topauthor + '"><?php $top_likes; ?></a><div><img src="./images/post/dlike-hover.png" alt="img" class="img-responsive dlike-hov"></div></div>
                    <div class="star-ratings-sprite"><span style="<?php echo $set_star; ?>" class="star-ratings-sprite-rating"></span></div>
                    <div class="row">
                        <div class="post_date"></div><div id="post_catg"></div>
                    </div>
                    
                    <h4 class="post-title">
                        <a href="#"><span id="top_title"></span></a>
                    </h4>
                    <p class="post-entry"></p>
                    <div class="post-footer">
                        <div class="post-author-block">
                            <div class="author-thumb">
                                <a href="#"><img src="" alt="img" class="img-responsive authThumb"></a>
                            </div>.
                            <div class="author-info">
                                <h5><a href="#" class="auth_name"></a></h5>
                            </div>
                        </div>
                        <div class="post-comments">
                            <img src="./images/post/cmnt-icon.png" alt="img" class="img-responsive">
                            <a href="#">03 Comments</a>
                        </div>
                    </div>
                </div>
    <? }
} 
?>
