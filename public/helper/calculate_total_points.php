<?php  include('./../includes/config.php');

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

  $sql_T = "SELECT username FROM prousers";
  $result_T = $conn->query($sql_T);
  $users = $result_T->fetch_all();
  $all_users = array();

  foreach($users as $user)
  {
    $user_name = $user[0];
// referrals check today (GMT)
    $sql4 = "SELECT count( DISTINCT(username) ) as total FROM Referrals where refer_by = '$user_name' and DAY(ADDTIME(entry_time, TIME(TIMEDIFF(LOCALTIMESTAMP, UTC_TIMESTAMP)))) = DAY(UTC_TIMESTAMP)";
    $result4 = $conn->query($sql4);
    $row4 = $result4->fetch_all();
    $my_referrals_today = $row4[0][0];
//get users all referral and their posts from api to multiply by 5 points
    $sql5 = "SELECT DISTINCT(username) as users FROM Referrals where refer_by = '$user_name'";
    $result5 = $conn->query($sql5);
    $row5 = $result5->fetch_all();
    if(is_null($row5)){
      $row5 = array();
    }
    $uname = array('username' => $user_name);
    $ref_today = array('referrals_today' => $my_referrals_today);
    $ref_users = array('referred_users'=>$row5);
    $user_obj = $uname + $ref_today + $ref_users;
    array_push($all_users, $user_obj);
  }
  $output = json_encode($all_users);
  $conn->close();

  function echoStr($str) {
    echo ('\'' . $str . '\'');
  }
?>


<script type="text/javascript">
let users = JSON.parse(<?php echoStr($output); ?>);
let url_updatePoints = "https://dlike.io/helper/update_prouser_points.php";
let url_retrievePostData = "https://dlike.io/helper/retrieve_post_data.php";

for(input of users)
{
  getCompleteUserData(input, function(data){
  	let totalPointValue = (data.totalViews * <?php echo($points_per_view); ?>) +
                          (data.totalLikes * <?php echo($points_per_like); ?>) +
                          (data.totalComments * <?php echo($points_per_comment); ?>) +
                          (data.totalUpvotes * <?php echo($points_per_upvote); ?>) +
                          (data.totalReferralPosts * <?php echo($points_per_referral_post); ?>) +
                          (input.referrals_today * <?php echo($points_per_referral_daily); ?>);
    $.ajax({
      url: url_updatePoints,
      type: "POST",
      data: {
        user: input.username,
        value: totalPointValue
      },
    });
    document.body.append("\nPOSTED " + totalPointValue + " points for user: " + input.username + "\n");
  });
}


function getCompleteUserData(user, callback){
	let referralData = {
  	"totalPosts":0
  };
	for(let i = 0; i<user.referred_users.length; i++)
  {
  	getDataByUser(user.referred_users[i][0], (referdata)=>{
    	referralData.totalPosts += referdata.totalPosts;
      if(i == user.referred_users.length - 1){
      	getDataByUser(user.username, (userdata)=>{
        	userdata.totalReferralPosts = referralData.totalPosts;
          callback(userdata);
        });
      }
    });
  }
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
      "totalPosts": 0,
      "totalViews":0,
      "totalLikes":0
    };
    steem.api.getDiscussionsByBlog(query, function(err, res)
    {
      let commentsHandled;
      let postsHandled;
      let upvoteSum = 0.0;
      let relevantRes = [];
      if(res.length <= 0 || res.error != null){
        callback(data);
        return;
      }

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
      if(relevantRes.length <= 0){
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
        $.ajax({
          url: url_retrievePostData,
          type: "POST",
          data: {
            permlink: $post.permlink,
          },
        }).done(function(post)
          {
            let last = (i == relevantRes.length - 1);
            data.totalViews += (notNull(post.views)) ? parseFloat(post.views) : 0;
            data.totalLikes += (notNull(post.likes)) ? parseFloat(post.likes) : 0;
            if(last)
            {
              postsHandled = true;
              if(commentsHandled){
                callback(data);
              }
            }
          });
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
          if (i2 == relevantRes.length - 1)
          {
            commentsHandled = true;
            if(postsHandled){
              callback(data);
            }
          }
        });
      });
    });
  });
}

function notNull(x){
	return (x != null && x != "null" && x != undefined && x != NaN);
}
</script>
