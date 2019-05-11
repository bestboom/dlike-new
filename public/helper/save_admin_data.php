<?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(0);
        require '../includes/config.php';
        if(isset($_POST['tag']) && $_POST['tag'] == "events"){
            if(!is_dir("Uploads/events/")) {
                $oldmask = umask(0);
                mkdir("Uploads/events/", 0777);
                umask($oldmask);
            }

            // Move the uploaded file
            move_uploaded_file($_FILES["upload"]["tmp_name"], "Uploads/events/". $_FILES["upload"]["name"]);

            $file_name = "Uploads/events/". $_FILES["upload"]["name"];
            $title = $_POST['title'];
            $tags = $_POST['tags'];
            
            $events = "INSERT INTO events (`title`,`image`, `tags`,`created_at`) VALUES ('".$title."', '".$file_name."', '".$tags."','".date("Y-m-d H:i:s")."')";
            $events_q = $conn->query($events);
            header("Location:/adminage/events.php");

        }
        
?>
