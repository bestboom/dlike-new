<?php  include('template/header7.php'); ?>
<style type="text/css">.reward_fileds {margin-bottom: 1px!important;}</style>
</div>



<?php
$sql1 =  $conn->query("SELECT * FROM dlike_daily_rewards where DATE(update_time) = CURDATE() order by update_time DESC Limit 1");

if ($sql1 && $sql1->num_rows > 0) 
{ 
    $row1 = $sql1->fetch_assoc();
    $yesterday_points = $row1["yesterday_upvotes"];
    $staking = $row1["dlike_staking"];
    $dao = $row1["dlike_dao"];
    $team = $row1["dlike_team"];
    $charity = $row1["dlike_charity"];
    $foundation = $row1["dlike_foundation"];


} else {
    $yesterday_points = 0;
}

echo $yesterday_points;



 $dataPoints = array(
    array("x" => 1483641000000 , "y" => 10),
    array("x" => 1483641000000 , "y" => 30),
    array("x" => 1483641000000 , "y" => 90),
    array("x" => 1483641000000 , "y" => 658),
    array("x" => 1483727400000 , "y" => 734),
    array("x" => 1483813800000 , "y" => 163),
    array("x" => 1483900200000 , "y" => 847),
    array("x" => 1483986600000 , "y" => 853),
    array("x" => 1484073000000 , "y" => 269),
    array("x" => 1484159400000 , "y" => 943),
    array("x" => 1484245800000 , "y" => 70),
    array("x" => 1484332200000 , "y" => 869),
    array("x" => 1484418600000 , "y" => 890),
    array("x" => 1484505000000 , "y" => 930)
 );


$sqlQuery = $conn->query("SELECT yesterday_upvotes,update_time FROM dlike_daily_rewards ORDER BY update_time");

//$jsonArray = array();
//foreach ($sqlQuery as $row) {
//    $data[] = $row;
//}

    if ($sqlQuery->num_rows > 0) {
        $data = array();
        //foreach ($sqlQuery as $row) {
        //    $data['x'] = strtotime($row['update_time']);
        //    $data['y'] = $row['yesterday_upvotes'];
        //}
      //Converting the results into an associative array
      while($row = $sqlQuery->fetch_assoc()) {
        $update = strtotime($row['update_time']);
        $votes = $row['yesterday_upvotes'];
        //$jsonArrayit = array();
        //$jsonArrayit['x'] = strtotime($row['update_time']);
        //$jsonArrayit['y'] = $row['yesterday_upvotes'];
        //append the above created object into the main array.
        //array_push($jsonArray, $jsonArrayit);
        //array_push($jsonArrayit['x'], $jsonArrayit['y']);
        $data[] = [(int)$update, (int)$votes];

        //$arrayName = array('' => , );
      }
    }

echo json_encode($data);
echo '<br>';
echo '<br>';
 //echo json_encode($jsonArray);
print_r($data);

echo '<br>';echo '<br>';




?>
https://canvasjs.com/php-charts/spline-area-chart/
https://www.fusioncharts.com/dev/using-with-server-side-languages/tutorials/php-mysql-charts

<div class="working-process-section" style="padding-top: 80px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6  col-md-6">
                <div class="user-connected-form-block" style="box-shadow: 0px 0px 10px 1px #cccccc;">
                    <h3 style="text-align: center;">
                        <div style="font-size: 1.1rem;">Reward Pool Today</div>
                        <div class="reward_amount">Likes Till Now: <?php echo $yesterday_points; ?></div>
                    </h3>
                    <form class="user-connected-from create-account-form reward_form" />
                     <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Authors" readonly>
                        <span class="fas fa-star inp_icon"></span>
                        <span class="inp_text"><?php echo $staking; ?></span>
                    </div>
                     <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Curators" readonly>
                        <span class="fas fa-star inp_icon"></span>
                        <span class="inp_text"><?php echo $staking; ?></span>
                    </div>
                     <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Affiliates" readonly>
                        <span class="fas fa-star inp_icon"></span>
                        <span class="inp_text"><?php echo $staking; ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Staking" readonly>
                        <span class="fas fa-star inp_icon"></span>
                        <span class="inp_text"><?php echo $staking; ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | DAO" readonly>
                        <span class="fas fa-bolt inp_icon"></span>
                        <span class="inp_text"><?php echo $dao; ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Charity" readonly>
                        <span class="fas fa-flask inp_icon"></span>
                        <span class="inp_text"><?php echo $charity; ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | AirDrop" readonly>
                        <span class="fas fa-database inp_icon"></span>
                        <span class="inp_text"><?php echo '0'; ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Team" readonly>
                        <span class="fas fa-database inp_icon"></span>
                        <span class="inp_text"><?php echo $team; ?></span>
                    </div>
                    <div class="form-group reward_fileds">
                        <input type="text" class="form-control reward_input" value=" | Foundation" readonly>
                        <span class="fas fa-database inp_icon"></span>
                        <span class="inp_text"><?php echo $foundation; ?></span>
                    </div>
                    <p>Time Remaining for Next Reward Pool</p>
                    <button type="button" class="btn btn-default reward_btn" disabled><span class="far fa-clock" style="font-size: 1.3rem;padding-right: 1rem;"></span><span class="dividendCountDown" style="font-size: 1.7rem;"></span></button>
                    <!--<p class="DlikeComments">Rewards are updated at certain intervals.</p>-->
                    </form>
                </div>
            </div>
            <div class="offset-lg-1 col-lg-5 col-md-6">
                <div class="working-process">
                    <h4 class="pool_head">DLIKE Daily Reward Pool Distribution</h4>
                    <p>
                        You can earn DLIKE tokens for your contributions to the DLIKE community. The more interactions you have, more will be the earnings. <br>DLIKE is simple proof of likes network where every like generates 1 DLIKE token. This generated token gets distributed into all sectors of DLIKE community as per following share.
                    </p>
                    <p style="color:#c51d24;font-weight: 600;">
                        <span class="fas fa-hand-point-right" style="padding-right: 10px;"></span>
                        Daily staking rewards are paid daily into your accounts..
                    </p>
                    <div>
                        <img src="/images/dlike_pool.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>

        <br>
        <div id="highContainer" style="height: 370px; width: 100%;"></div>
    </div>
</div><!-- working-process-section-->
<?php include('template/dlike_footer.php'); ?>
<script type="text/javascript">
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
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title:{
        text: "Site Traffic"
    },
    axisX: {
        valueFormatString: "DD MMM"
    },
    axisY: {
        title: "Total Number of Visits",
        maximum: 1200
    },
    data: [{
        type: "splineArea",
        color: "#6599FF",
        xValueType: "dateTime",
        xValueFormatString: "DD MMM",
        yValueFormatString: "#,##0 Visits",
        dataPoints: <?php echo json_encode($data); ?>
    }]
});
 
chart.render();
 
}
</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
var chart = new Highcharts.Chart({
      chart: {
         renderTo: 'highContainer'
      },
      series: [{
         data: <?php echo json_encode($data); ?>
      }]
});
</script>