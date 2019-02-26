<?php
$sqlt = "SELECT * FROM PostsLikes ORDER BY likes DESC LIMIT 1";
$result = $conn->query($sqlt);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $top_auth = $row["author"];
        $top_permlink = $row["permlink"];
        ?>
        <script>
            let topauthor = <?php echo json_encode($top_auth); ?>;
            let toppermlink = <?php echo json_encode($top_permlink); ?>;
        </script>
<div class="col-md-6 post-thumb">
                    <a href="#"><img src="" alt="img" class="card-img-top2 img-fluid" id="top_img"></a>
                </div>
                <div class="col-md-6 post-contnet-wrap">
                    <span class="post-meta">30 NOV, 2019</span>
                    <h4 class="post-title">
                        <a href="#"><span id="top_title"></span></a>
                    </h4>
                    <p class="post-entry"></p>
                    <div class="post-footer">
                        <div class="post-author-block">
                            <div class="author-thumb">
                                <a href="#">
                                    <img src="./images/post/authors/1.png" alt="img" class="img-responsive">
                                </a>
                            </div>.
                            <div class="author-info">
                                <h5>
                                    <a href="#">
                                        Nayn e Castro
                                    </a>
                                </h5>
                                <a href="#">@excoin</a>
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
