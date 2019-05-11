<?php include('../includes/config.php'); ?>
<?php include('../template/header.php'); ?>
<style>
  .support-category-block i{font-size:85px;color:white;}
  
  /* Center the loader */
#loader {
  position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    margin: -60px 0 0 -60px;
    border: 7px solid #4147a1;
    border-radius: 50%;
    border-top: 7px solid #4147a1;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s ease-in-out infinite; 
    animation: spin 2s ease-in-out infinite;
  
      text-align: center;
    font-size: 22px;
    padding-top: 38px;
      background: #4147a1;
    color: #ffffff;
  
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}
@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}
@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}
    .myloader{display:none;}
    .admin-latest-post-section{position:relative;}
</style>
</div>
