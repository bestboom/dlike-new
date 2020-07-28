<?php include('../template/header7.php');
require '../includes/config.php';
?> 
</div>
<?php
$t=time();
echo($t . "<br>");
echo(date("Y-m-d",$t));
echo '<br>';
$sql_C = $conn->query("SELECT DATE(curation_time) as total FROM dlike_upvotes where DATE(curation_time) = SUBDATE(CURRENT_DATE(), 1)");

$row_C = $sql_C->fetch_assoc() or die($conn->error);
echo $time = $row_C["total"]; 
?>
<div class="header-menu collapse d-lg-flex p-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="./" class="nav-link steem-keychain-checked">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item nav-link add_account" style="cursor: pointer;"><i class="fa fa-plus"></i> Add Account</li>
                    <li class="nav-item nav-link accounts_list" style="cursor: pointer;"><i class="fa fa-users"></i> Admin Accounts</li>
                    <li class="nav-item">
                        <a href="./token_holders.php" class="nav-link steem-keychain-checked">
                            <i class="fa fa-heart"></i> Token Holders
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top:30px;margin-bottom: 30px;"><div class="row row-cards">
    <div class="col-sm-6 col-lg-3">
        <div class="queue-stats card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-blue mr-3">
                  <i class="fa fa-list"></i>
                </span>
                <div>
                    <h4 class="m-0">
                        <small>In QUEUE</small>
                    </h4>
                    <small class="queue-stats-display text-muted">No posts in the Queue</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-orange mr-3">
                  <i class="fa fa-money"></i>
                </span>
                <div>
                    <h4 class="m-0">
                        <small>Vote worth</small>
                    </h4>
                    <small class="text-muted">
                        <span class="run-bot-voteWorth">1.128 SBD</span>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="bot-power card p-3">
            <div id="voting-power" class="d-flex align-items-center">
                <span class="stamp stamp-md bg-green mr-3">
                  <i class="fa fa-battery-half"></i>
                </span>
                <div style="width: 100%">
                    <h4 class="m-0">
                        <small>Dlike Voting Power</small>
                    </h4>
                    <div>
                        <div class="clearfix">
                            <div class="float-left">
                                <strong class="voting-power-display">95.71%</strong>
                            </div>
                            <div class="float-right">
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-green mr-3">
                  <i class="fa fa-check"></i>
                </span>
                <div>
                    <h4 class="m-0">
                        <small>Last Vote</small>
                    </h4>
                    <small class="text-muted">
                        <span class="run-bot-lastVote">7/25/2020 10:20:00 PM</span>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div></div>
<div class="container">
    <div class="user-login-signup-form-wrap add_account_section" style="padding: 7rem 0rem; display: none;">
        <div class="modal-content" style="background: #1b1e63;border-radius: 14px;">
            <div class="modal-body">
                <div class="share-block"><p>Add New Account</p></div>
                <div class="user-connected-form-block" style="background: #1b1e63;">
                    <form class="user-connected-from">
                    	<input type="hidden" id="reset_email_id" value="<?php echo $email; ?>" />
                        <div class="input-group mb-3" style="padding: 3px;">
                            <div class="input-group-prepend"><div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-user"></span></div></div>
                            <input type="text" name="user_acc" id="user_acc" placeholder="UserName" class="form-control" style="padding: 8px;" />
                        </div>
                        <div class="input-group mb-3" style="padding: 3px;">
                            <div class="input-group-prepend"><div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-lock"></span></div></div>
                            <input type="password" name="acc_password" id="acc_password" placeholder="Password" class="form-control" style="padding: 8px;" />
                        </div>
                        <div class="input-group mb-3" style="padding: 3px;">
                            <div class="input-group-prepend"><div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-user"></span></div></div>
                            <input type="email" name="acc_email" id="acc_email" placeholder="Email Address" class="form-control" style="padding: 8px;" />
                        </div>
                        <center><button type="button" class="btn btn-default add_account_btn" style="width: 40%;margin-top: 15px;">Add Account</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div><!--end add account-->
    <div class="latest-tranjections-area accounts_list_section" style="display: none;">
        <div class="latest-tranjections-block">
            <div class="container">
                <div class="latest-tranjections-block-inner">
                    <div class="panel-heading-block"><h5>Top Stakings Accounts</h5></div>
                    <table class="table coin-list latest-tranjections-table">
                        <thead>
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">UserName</th>
                                <th scope="col">UserName</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sql_st = $conn->query("SELECT * FROM dlikeaccounts where admin_account=1");
                                if ($sql_st->num_rows > 0) {
                                    while($row_t = $sql_st->fetch_assoc()) {$dlk_adm_user=$row_t["username"];
                                    $sql_bu = $conn->query("SELECT * FROM dlike_wallet where username='$dlk_adm_user'");$row_bu = $sql_bu->fetch_assoc()?> 
                            <tr>   
                                <td><?php echo $row_t["id"]; ?></td>
                                <td><?php echo $row_t["username"]; ?></td>
                                <td><?php echo $row_bu["amount"]; ?></td>
                            </tr>
                            <? } }?>
                        </tbody>
                    </table>
                </div><!-- order-history-block-inner -->
            </div>
        </div>
    </div> <!--end account list-->
</div> 
<?php include('../template/dlike_footer.php'); ?>
<script type="text/javascript">
	$('.add_account').click(function() {$(".add_account_section").show();});
    $('.accounts_list').click(function() {$(".accounts_list_section").show();});
	$('.add_account_btn').click(function() {
		let add_user = $('#user_acc').val();
        if (add_user == "") {toastr.error('phew... User Value empty!');return false;}
        let add_pass = $('#acc_password').val();
        if (add_pass == "") {toastr.error('phew... Password Value empty!');return false;}
        let add_email = $('#acc_email').val();
        if (add_email == "") {toastr.error('phew... Email Value empty!');return false;}
        $.ajax({ type: "POST",url: "/adminage/backit.php", data: {action : 'add_account',user: add_user,pass: add_pass,email: add_email},
            success: function(data) {
                try { var response = JSON.parse(data)
                    if (response.error == true) {toastr.error(response.message);return false;
                    } else {toastr.success(response.message);setTimeout(function(){window.location.reload();}, 400);}
                } catch (err) {toastr.error('Sorry. Server response is malformed.');}
            }
        });
	});
</script>