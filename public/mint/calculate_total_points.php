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

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
      .tt:hover::after{
      background-color:white;
      content: attr(tooltip);
      position: absolute;
      border: 1px solid black;
      white-space: pre;
      padding:3px;
      margin: 1px auto;
      font-size: 15px;
      }

      .tt {
      color:blue;
      text-decoration:underline;
      }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://cdn.steemjs.com/lib/latest/steem.min.js"></script>

  </head>
  <body>


  <script type="text/javascript">
  let users = JSON.parse(<?php echoStr($output); ?>);
  let url_updatePoints = "https://dlike.io/helper/update_prouser_points.php";
  let url_retrievePostData = "https://dlike.io/helper/retrieve_post_data.php";
  let count = 1;

  for(let input of users)
  {
  	console.log(input)
    getCompleteUserData(input, function(data){
    	let totalPointValue = (data.totalViews * 0.2) +
                            (data.totalLikes * 20) +
                            (data.totalComments * 10) +
                            (data.totalUpvotes * 100) +
                            (data.totalReferralPosts * 5) +
                            (input.referrals_today * 50);
      $.ajax({
        url: url_updatePoints,
        type: "POST",
        data: {
          user: input.username,
          value: totalPointValue
        },
      });

      let tooltip = "Comments: " + data.totalComments + "&#xa;" +
                    "Upvotes: " + data.totalUpvotes + "&#xa;" +
                    "Views: " + data.totalViews + "&#xa;" +
                    "Likes: " + data.totalLikes + "&#xa;" +
                    "Referral Posts: " + data.totalReferralPosts + "&#xa;" +
                    "Referrals Today: " + input.referrals_today;


      document.body.innerHTML += "<div>" + count + '. Calculated <span class="tt" tooltip="' + tooltip + '">' + totalPointValue + "</span> points for user: " + input.username + "</div>";
      count++;
    });
  }


  function getCompleteUserData(user, callback)
  {
  	let referralData = {
    	"totalPosts":0,
    };
    if(user.referred_users.length > 0)
    {
      for(let i = 0; i<user.referred_users.length; i++)
      {
        getDataByUser(user.referred_users[i][0], (referdata)=>
        {
          referralData.totalPosts += referdata.totalPosts;
          if(referdata.index == user.referred_users.length - 1)
          {
            getDataByUser(user.username, (userdata)=>{
              userdata.totalReferralPosts = referralData.totalPosts;
              callback(userdata);
            });
          }
        }, i);
     	}
    }else
    {
    	console.log("no referrals...");
      getDataByUser(user.username, (userdata)=>{
        userdata.totalReferralPosts = 0;
        document.body.innerHTML += "Running Callback";
        callback(userdata);
      });
    }
  }

  function getDataByUser(username, callback, index) {
    $(document).ready(function() {
      let query;
      console.log(username);
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
        "totalLikes":0,
        "index":index
      };
      steem.api.getDiscussionsByBlog(query, function(err, res)
      {
        let commentsHandled;
        let postsHandled;
        let upvoteSum = 0.0;
        let relevantRes = [];
        if(res.length <= 0 || res.error != null){
          callback(data);
          console.log("no result");
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
          console.log("no relevant result");
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
              permlink: posts,
            },
          }).done(function(response)
            {
              console.log("RESPONSE:");
              console.log(response);
              let responseObj = JSON.parse(response);

              let last = (i == relevantRes.length - 1);
              data.totalViews += notNull(responseObj.views) ? responseObj.views : 0;
              data.totalLikes += notNull(responseObj.views) ? responseObj.likes : 0;
              if(last)
              {
                postsHandled = true;
                if(commentsHandled){
                  callback(data);
                }
              }
            }).fail(()=>{
              document.body.innerHTML += "Views and Likes ERROR for user: " + username;
            let last = (i == relevantRes.length - 1);
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
  	return (x != null && x != "null" && x != undefined);
  }
  </script>
</body>
</html>
