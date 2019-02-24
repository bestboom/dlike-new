<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo getenv("AQ");
  # get the mongo db name out of the env
echo getenv("MONGO_URL");
  $mongo_url = parse_url(getenv("MONGO_URL"));
  echo $dbname = str_replace("/", "", $mongo_url["path"]);


?>