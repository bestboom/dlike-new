<?php
include "./template/header5.php"; 
$user_name = $_COOKIE['username'];
?>
</div>
<div id="loadings"><img src="/images/loader.svg" width="100"></div>
<style>
.row-3 { justify-content: space-between;width: 98%;padding: 12px 18px 6px 8px;}
.row-2 {justify-content: space-between;background-color: #f4f4f4;width: 98%;padding: 12px 18px 12px 8px;}
</style>

<?php
include "./template/footer.php"; 
?>
<script type="text/javascript">
    $( document ).ready(function() {    
        $('#loadings').delay(6000).fadeOut('slow');
    }   
</script>