<?php include('template/header7.php');?>
</div><!-- sub-header -->
<?php
$sql_T = "SELECT * FROM dlikeposts ORDER BY created_at DESC";
    $result_T = $conn->query($sql_T);

    if ($result_T && $result_T->num_rows > 0) { 
        while ($row_T = $result_T->fetch_assoc()) { 
            ?>
            <tr>
                <td class="exp-user cent_me wid_2">
                    <span><?php echo $row_T["username"]; ?></span>
                </td>
                <td class="exp-user cent_me wid_2">
                    <span><?php echo $row_T["title"]; ?></span>
                </td>
                <td class="exp-amt cent_me wid_2">
                    <span><?php echo $row_T["description"]; ?></span>
                </td>
                <td class="exp-amt cent_me wid_2">
                    <span><?php echo $row_T["tags"]; ?></span>
                </td>
            </tr>
            <?php
        }
    }
?> 
        </tbody>
    </table>
</div>
<div class="latest-post-section" style="min-height:80vh;padding: 70px 0px 60px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <article class="post-style-two">
                    <div class="post-contnet-wrap-top">
                    <div class="post-footer">
                    <div class="post-author-block">
                    <div class="author-thumb"><a href="/@' + $post.author + '"><img src="https://steemitimages.com/u/' + $post.author + '/avatar" alt="img" class="img-responsive"></a></div>
                    <div class="author-info">
                    <h5><a href="/@' + $post.author + '">' + $post.author  + "&nbsp;" +adduserhtml +'</a><div class="time">' + activeDate + '</div></h5> 
                    </div>
                    </div>
                    <div class="post-comments post-catg"><a href="/category/' + category_link + '"><span class="post-meta">' + category + '</span></a></div>
                    </div>
                    </div>
                    <div class="post-thumb img-fluid"><a href="/post/@' + $post.author + '/' + $post.permlink + '">' + thumbnail + '</a></div>
                    <div class="post-contnet-wrap">
                    <div class="row d-flex justify-content-center hov-it"><div class="hov-item"><img src="./images/post/dlike-hover.png" alt="img" class="img-responsive"><span class="hov_me" data-toggle="modal" data-target="" data-likes="" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><div class="hov-txt"><h5><span id="hov-num" class="commentsDiv' + currentLikesDivElement + '"></span></h5></div></span></div></div>
                    <h4 class="post-title"><a href="/post/@' + $post.author + '/' + $post.permlink + '">' + $post.title + '</a></h4>
                    <p class="post-entry post-tags">' + metatags + '</p>
                    <div class="post-footer">
                    <div class="post-author-block">
                    <div class="author-info"><i class="fas fa-dollar-sign"></i><span>&nbsp;' + $post.pending_payout_value.substr(0, 4) + '</span> <b>+</b> <span id="se_token'+newValue +'" data-popover="true" data-html="true" data-content="">0</span> <b>DLIKER</b></div>
                    </div>
                    <div class="post-comments"><a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+newValue+'"></i></a><span>&nbsp;$post.active_votes.length + '</span>&nbsp; | &nbsp;<i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+$post.permlink +$post.author +'">0</span></div>
                    </div>
                    </div>
                </article></div>
        </div>
    </div>  

<?php include('template/dlike_footer.php'); ?>