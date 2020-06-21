<!DOCTYPE html>
<head>
  <title>Steem Logout</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  <script src="/js/steemconnect.js"></script>
</head>
<script>
$(document).ready(function(){
  api.revokeToken(function(err_log, result_log) {
    if (result_log && result_log.success) {
      $.removeCookie('username', { path: '/' });
      $.removeCookie('access_token', { path: '/' });
      document.location.href = '/';
    }
  });
});
</script>
</html>