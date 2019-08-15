<?php  include('template/header5.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// POINTS SPECIFICATION
$points_per_view = '0.2';
$points_per_like = '20';
$points_per_comment = '10';
$points_per_upvote = '100';
$points_per_referral_daily = '50';
$points_per_referral_post = '5';
$total_reward = 7000;

$referred_users = "";
$dump_log = "";

$user_status = "You Must Login";
        $my_points = "0";
        $my_share = "0%";
        $my_earnings = "0 DLIKE";

// <! --------- ONLY FOR TESTING PURPOSES -------->
$_COOKIE['username'] = "certseek";
$total_points = 1000;
// <! --------- ONLY FOR TESTING PURPOSES -------->

if (isset($_COOKIE['username']) || $_COOKIE['username'])
{
    $user_name = $_COOKIE['username'];
    $sql_T = "SELECT * FROM prousers where username='$user_name'";
    $result_T = $conn->query($sql_T);

    // if ($result_T && $result_T->num_rows > 0) {
    //     $row_T  = $result_T->fetch_assoc();

        $sql1 = "SELECT * FROM steemposts where username = '$user_name' and DAY(ADDTIME(created_at, TIME(TIMEDIFF(LOCALTIMESTAMP, UTC_TIMESTAMP)))) = DAY(UTC_TIMESTAMP)";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            $mydata = array();
            while($row1 = $result1->fetch_assoc()) {
                $mydata[] = $row1['permlink'];
            }
            $permlinks_list = implode("','", $mydata);
        }
// views call

        $sql2 = "SELECT SUM(totalviews) AS views FROM TotalPostViews where author = '$user_name' and permlink  IN ('$permlinks_list')";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $my_views = $row2['views'];

// likes check

        $sql3 = "SELECT SUM(likes) AS total_likes FROM PostsLikes where author = '$user_name' and permlink  IN ('$permlinks_list')";
        $result3 = $conn->query($sql3);
        $row3 = $result3->fetch_assoc();
        $my_likes = $row3['total_likes'];

// referrals check today (GMT)

        $sql4 = "SELECT count( DISTINCT(username) ) as total FROM Referrals where refer_by = '$user_name' and DAY(ADDTIME(entry_time, TIME(TIMEDIFF(LOCALTIMESTAMP, UTC_TIMESTAMP)))) = DAY(UTC_TIMESTAMP)";
        $result4 = $conn->query($sql4);
        $row4 = $result4->fetch_assoc();
        $my_referrals_today = $row4['total'];

// get users all referral and their posts from api to multiply by 5 points
        $sql5 = "SELECT DISTINCT(username) as users FROM Referrals where refer_by = '$user_name'";
        $result5 = $conn->query($sql5);
        $row5 = $result5->fetch_all();
        $dump_log .= var_dump($row5);
        if(is_null($row5)){
          $row5 = array();
        }
        $referred_users = json_encode($row5);

// calculate points

        $my_views_points = $my_views * $points_per_view;
        $my_likes_points = $my_likes * $points_per_like;
        $my_referrals_today_points = $my_referrals_today * $points_per_referral_daily;

        $my_points = $my_views_points + $my_likes_points + $my_referrals_today_points;



        // } else {$my_permlinks = '';}

        $user_status = "";
        $my_share = "";
        $my_earnings = "";

    // } else {
    //     $user_status = "You Are not a PRO user";
    //     $my_points = "0";
    //     $my_share = "0%";
    //     $my_earnings = "0 DLIKE";
    // }
}

function echoStr($str) {
  echo ('\'' . $str . '\'');
}
?>
</div><!-- sub-header -->
<div class="working-process-section" style="padding-top: 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6  col-md-6">
                <div class="working-process">
                    <h4 class="pool_head">DLIKE REWARD POOL</h4>
                    <p>
                        You can earn tokens for your contributions to the DLIKE network. The more interactions on your content, the greater your share of the daily token reward pool to your OffChain wallet.
                    </p>
                    <p style="color:#c51d24;font-weight: 600;">
                        <span class="fas fa-hand-point-right" style="padding-right: 10px;"></span>
                        DLIKE reward pool is only available to PRO users
                    </p>
                    <div>
                        <img src="/images/post/dlike-reward.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="offset-lg-1 col-lg-5 col-md-6">
                <div class="user-connected-form-block" style="box-shadow: 0px 0px 10px 1px #cccccc;">
                    <h3 style="text-align: center;">
                        <div style="font-size: 1.1rem;">Total Reward Pool</div>
                        <div class="reward_amount">7,000 DLIKE</div>
                    </h3>
                    <p style="margin-top: -20px;font-weight: 600;color: red;"><?php echo $user_status; ?></p>


                    <p><?php  ?></p>



                    <form class="user-connected-from create-account-form reward_form" />
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Total Points" readonly>
                        <span class="fas fa-star inp_icon"></span>
                        <span class="inp_text" id="totalPoints"></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | My Points" readonly>
                        <span class="fas fa-bolt inp_icon"></span>
                        <span class="inp_text" id="myPoints"></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | My Share" readonly>
                        <span class="fas fa-flask inp_icon"></span>
                        <span class="inp_text" id="myShare"></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Estimated Reward" readonly>
                        <span class="fas fa-database inp_icon"></span>
                        <span class="inp_text" id="myEarnings"></span>
                    </div>
                    <p>Time Remaining for Next Reward Pool</p>
                    <button type="button" class="btn btn-default reward_btn" disabled><span class="far fa-clock" style="font-size: 1.3rem;padding-right: 1rem;"></span><span class="dividendCountDown" style="font-size: 1.7rem;"></span></button>
                    <p class="DlikeComments">By staking you agree to the Terms</p>
                    <div id="output"></div>
                </div><!-- create-account-block -->
            </div>
        </div>
        <div class="features-section" style="padding-top: 40px;">
            <div class="container pool_box">
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <div class="features-block-icons">
                            <span class="fab fa-gratipay reward_icon"></span>
                            <p>Likes <br>
                                <span style="font-size: 0.7rem;">Each like on your posts</span>
                                <br><span class="head_color">20+</span>
                            </p>
                        </div><!-- features-block -->
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <div class="features-block-icons">
                            <span class="fas fa-eye reward_icon"></span>
                            <p>Views <br><span style="font-size: 0.7rem;">For 100 views on your posts</span><br>
                                <span class="head_color">20+</span></p>
                            </div><!-- features-block -->
                        </div>
                        <div class="col-md-2 col-sm-3">
                            <div class="features-block-icons">
                                <span class="fas fa-comment-alt reward_icon"></span>
                                <p>comments <br><span style="font-size: 0.7rem;">Each one on your posts</span>
                                    <br><span class="head_color">10+</span>
                                </p>
                            </div><!-- features-block -->
                        </div>
                        <div class="col-md-2 col-sm-3">
                            <div class="features-block-icons">
                                <span class="fas fa-chevron-circle-up reward_icon"></span>
                                <p>upvotes <br><span style="font-size: 0.7rem;">$1 steem upvote</span>
                                    <br><span class="head_color">100+</span>
                                </p>
                            </div><!-- features-block -->
                        </div>
                        <div class="col-md-2 col-sm-3">
                            <div class="features-block-icons">
                                <span class="fas fa-users reward_icon"></span>
                                <p>Referralss <br><span style="font-size: 0.7rem;">Each New Referral </span>
                                    <br><span class="head_color">50+</span>
                                </p>
                            </div><!-- features-block -->
                        </div>
                        <div class="col-md-2 col-sm-3">
                            <div class="features-block-icons">
                                <span class="fas fa-user-plus reward_icon"></span>
                                <p>Referral Income <br><span style="font-size: 0.7rem;">Each Post By Your Referrals</span><br/><span class="head_color">5+</span></p>
                            </div><!-- features-block -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- working-process-section-->
    <?php $conn->close(); include('template/footer3.php'); ?>
    <script type="text/javascript">
    let userObj = JSON.parse(<?php echoStr($referred_users); ?>);
    let users = Object.values(userObj).slice(0);
    console.log(users);

    let pointsFromDB = <?php echo($my_points); ?>;
    console.log(pointsFromDB);
    // Tally up referral points
    let referralPostPoints = 0.0;

    if(users.length > 0)
    {
      let itemsProcessed = 0;
      for(let i = 0; i<users.length; i++)
      {
        getDataByUser(users[i], (x)=>{
          console.log(x)
          let pointsPerRefPost = <?php echo($points_per_referral_post) ?>;
          referralPostPoints += parseFloat(x.totalPosts) * pointsPerRefPost;
          console.log(referralPostPoints);
          itemsProcessed++;
          if(itemsProcessed === users.length)
          {
            referralTallied(referralPostPoints);
          }
        });
      }
    }else{
      referralTallied(0);
    }
    function getDataByUser(username, callback) {
      $(document).ready(function() {
        let query;
        if (username != null) {
          query = {
            tag: username,
            limit: 12,
          }
        }
        let data = {
          "totalComments": 0,
          "totalUpvotes": 0.0,
          "totalPosts": 0
        };

        steem.api.getDiscussionsByBlog(query, function(err, res) {
          let upvoteSum = 0.0;
          let relevantRes = [];
          if(!res || res.length <= 0 || res.error){
            callback(data);
            return;
          }
          console.log(res);
          res.forEach(($post) => {
            let postTime = moment.utc($post.created);
            if (postTime.format('D') == moment.utc().format('D')) {
              // Check community
              let metadata;
              if ($post.json_metadata && $post.json_metadata.length > 0) {
                metadata = JSON.parse($post.json_metadata);
                if (metadata.community == "dlike")
                  relevantRes.push($post);
                data.totalPosts = relevantRes.length;
              }
            }
          });
          if(!relevantRes || relevantRes.length <= 0){
            callback(data);
            return;
          }
          relevantRes.forEach(($post, i) => {
            let posts = $post.permlink;
            let upvotes = $post.pending_payout_value;
            let postTime = moment.utc($post.created);
            let activeDate = moment.utc($post.created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
            let parsedVote = parseFloat(upvotes.match(/\d\.\d+(?= SBD)/)[0]);
            data.totalUpvotes += parsedVote;
            steem.api.getContentReplies(username, posts, function(err, result) {
              let i2 = i;
              result.forEach((comment, j) => {
                let metadata;
                if (comment.json_metadata && comment.json_metadata.length > 0) {
                  metadata = JSON.parse(comment.json_metadata);
                }
                if (metadata.community == "dlike") {
                  data.totalDlikeComments++;
                }
              });
              if (i2 == relevantRes.length - 1) {
                callback(data);
                return;
              }
            });
          });
        });
      });
    }
    function referralTallied(total)
    {
      getDataByUser(<?php echoStr($user_name); ?>, (x)=>{
        let commentPoints = x.totalComments * <?php echo($points_per_comment . ";\n"); ?>
        let upvotePoints = x.totalUpvotes * <?php echo($points_per_upvote . ";\n"); ?>
        let grandTotal = parseFloat(commentPoints) + parseFloat(upvotePoints) + parseFloat(referralPostPoints) + parseFloat(pointsFromDB);
        output(grandTotal)
      });
    }
    var countDownDate = 0;
    function counter() {
        setInterval(() => {
            var date = new Date().toLocaleString("en-US", { timeZone: "Europe/London"});
            var countDownDate = new Date(date);
            var i = 60;
            var h = 24 - countDownDate.getHours();
            if (h < 10) {
                h = "0" + h;
            }
            var m = 59 - countDownDate.getMinutes();
            if (m < 10) {
                m = "0" + m;
            }
            var s = countDownDate.getSeconds();
            s = i - s;
            if (s < 10) {
                s = "0" + s;
            }
            str = h + ":" + m + ":" + s;
            i++;
            $(".dividendCountDown").html(str);
        }, 1000);
    };
    counter();

    function output(x)
    {
        let totalPts = <?php echo($total_points) ?>;
        document.getElementById("totalPoints").innerHTML = totalPts;
        document.getElementById("myPoints").innerHTML = x;
        document.getElementById("myShare").innerHTML = (x/totalPts) * 100 + "%";
        document.getElementById("myEarnings").innerHTML = <?php echo($total_reward); ?> * (x/totalPts);
    }


    </script>
