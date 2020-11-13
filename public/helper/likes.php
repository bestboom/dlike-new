<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Us</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->
<style>
body {
    background: -webkit-linear-gradient(left, #0072ff, #00c6ff);
}
.contact-form {
    background: #fff;
    margin-top: 5%;
    margin-bottom: 5%;
    width: 70%;
}
.contact-form .form-control {
    border-radius:1rem;
}
.contact-image {
    text-align: center;
}
.contact-image img {
    border-radius: 6rem;
    width: 11%;
    margin-top: -3%;
    transform: rotate(29deg);
}
.contact-form form {
    padding: 14%;
}
.contact-form form .row {

}
.contact-form h3 {
    margin-bottom: 8%;
    margin-top: -10%;
    text-align: center;
    color: #0062cc;
}
.contact-form .btnContact {
    width: 50%;
    border: none;
    border-radius: 1rem;
    padding: 1.5%;
    background: #dc3545;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
}
.btnContactSubmit {
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    color: #fff;
    background-color: #0062cc;
    border: none;
    cursor: pointer;
}
</style>

<script src="https://www.google.com/recaptcha/api.js?render=6Lf_z-EZAAAAAKxATqLuutAIhY7tYSAvAuzXoQi-"></script>
<?php
if(isset($_POST) && isset($_POST["btnSubmit"]))
{
    $secretKey  = '6Lf_z-EZAAAAAAjjdYliFzv738Txzeyw4HIIN0hI';
    $token      = $_POST["g-token"];
    $ip         = $_SERVER['REMOTE_ADDR'];
   
    /* ======================= POST METHOD =====================*/ 
    //$url = "https://www.google.com/recaptcha/api/siteverify?";
    //$data = array('secret' => $secretKey, 'response' => $token, 'remoteip'=> $ip);
    $url = "https://www.google.com/recaptcha/api/siteverify?".$recpatch_key."&response=".$token."&remoteip=".$g_ip;
    $request = file_get_contents($url);
    $g_response = json_decode($request);
    print_r($g_response);
    if($g_response->success)
    {
        echo '<center><h1>Validation Success!</h1></center>';
    }
    else
    {
        echo '<center><h1>Captcha Validation Failed..!</h1></center>';
    }
    /*==========================================================*/
   
}
?>
</head>
<body>
<div class="container contact-form">
  <form method="post">
    <input type="hidden" id="g-token" name="g-token" />
    <h3>Have a Question? Write us</h3>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" required />
        </div>
        <div class="form-group">
          <input type="text" name="txtEmail" class="form-control" placeholder="Your Email *" value="" required />
        </div>
        <div class="form-group">
          <input type="text" name="txtSubject" class="form-control" placeholder="Subject *" value="" required />
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height:140px;" required></textarea>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
              <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" required />
            </div>
        </div>
    </div>
  </form>
</div>

<script>
grecaptcha.ready(function() {
    grecaptcha.execute('6Lf_z-EZAAAAAKxATqLuutAIhY7tYSAvAuzXoQi-', {action: 'homepage'}).then(function(token) {
        console.log(token);
       document.getElementById("g-token").value = token;
    });
});
</script>
</body>
</html>