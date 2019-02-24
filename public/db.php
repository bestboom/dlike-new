<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  # get the mongo db name out of the env
  $mongo_url = parse_url(getenv("MONGO_URL"));
  $dbname = str_replace("/", "", $mongo_url["path"]);

  # connect
  $m   = new MongoClient(getenv("MONGO_URL"));
  $db  = $m->$dbname;
  $col = $db->access;

  # insert a document
  $visit = array( "ip" => $_SERVER["HTTP_X_FORWARDED_FOR"] );
  $col->insert($visit);

  # print all existing documents
  $data = $col->find();
  foreach($data as $visit) {
    echo "<li>" . $visit["ip"] . "</li>";
  }

  # disconnect
  $m->close();
?>
