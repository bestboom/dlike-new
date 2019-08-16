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
      $user_obj = array();
      $user_name = $user[0];
// referrals check today (GMT)
      $sql4 = "SELECT count( DISTINCT(username) ) as total FROM Referrals where refer_by = '$user_name'";
       // and DAY(ADDTIME(entry_time, TIME(TIMEDIFF(LOCALTIMESTAMP, UTC_TIMESTAMP)))) = DAY(UTC_TIMESTAMP)";
      $result4 = $conn->query($sql4);
      $row4 = $result4->fetch_all();
      $my_referrals_today = $row4['total'];

      array_push($user_obj, 'referrals_today'=>$my_referrals_today);

//get users all referral and their posts from api to multiply by 5 points
      $sql5 = "SELECT DISTINCT(username) as users FROM Referrals where refer_by = '$user_name'";
      $result5 = $conn->query($sql5);
      $row5 = $result5->fetch_all();
      if(is_null($row5)){
        $row5 = array();
      }
      // $referred_users = json_encode($row5);
      array_push($user_obj, 'referred_users'=>$row5);
      array_push($all_users, $user_obj);
    }

    var_dump($all_users);
    $conn->close();
    die();

    function echoStr($str) {
      echo ('\'' . $str . '\'');
    }
?>


<script type="text/javascript">
let users = JSON.parse(<?php echoStr($referred_users); ?>);
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
    getDataByUser(users[i][0], (x)=>{
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
      if(res.length <= 0 || res.error != null){
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

        let xhr = new XMLHttpRequest();
        let url = "https://dlike.io/helper/retrieve_post_data.php";
        let params = 'permlink='+$post.permlink;
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function()
        {
          let last = false;
          if(i == relevantRes.length - 1)
          {
            last = true;
          }
            if(xhr.responseText.length > 0 && xhr.status == 200){
              handlePostData(xhr.responseText, last);
            }else{
              console.error(xhr);
              if(last){
                postsHandled = true;
                if(commentsHandled){
                  output();
                }
              }
            }
        }
        xhr.send(params);
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
    if(postsHandled)
    {
      output(grandTotal);
    }else {
      bank(grandTotal);
      commentsHandled = true;
    }
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

let views = 0;
let likes = 0;
let postsHandled = false;
function handlePostData(x, last)
{
    let post = JSON.parse(x);
    if(post.views != null && post.views != "null" && post.views != undefined && post.views != NaN)
    {
      views += parseFloat(post.views);
    }
    if(post.likes != null && post.likes != "null" && post.likes != undefined && post.likes != NaN)
    {
      likes += parseFloat(post.likes);
    }
    if(last){
      if(commentsHandled){
        output();
      }else{
        postsHandled = true;
      }
    }
}

function output(x = 0)
{
    let viewPoints = views * <?php echo($points_per_view . ";\n"); ?>
    let likePoints = likes * <?php echo($points_per_like . ";\n"); ?>
    let totalPts = <?php echo($total_points) ?>;
    let myPoints = x + bankedPts + viewPoints + likePoints;
    document.getElementById("totalPoints").innerHTML = totalPts;
    document.getElementById("myPoints").innerHTML = myPoints;
    document.getElementById("myShare").innerHTML = scale((myPoints/totalPts) * 100) + "%";
    document.getElementById("myEarnings").innerHTML = scale(<?php echo($total_reward); ?> * (myPoints/totalPts));
}
let bankedPts = 0;
let commentsHandled = false;
function bank(x){
  bankedPts = x;
}
function scale(num) {
  return Math.round(num * 100) / 100
}

</script>
