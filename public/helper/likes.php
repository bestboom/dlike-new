<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';



$sqlt = "SELECT * FROM PostsLikes ORDER BY likes DESC LIMIT 1";
$result = $conn->query($sqlt);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $top_auth = $row["author"];
        $top_permlink = $row["permlink"];

        ?>
        <script>
        	let topauthor = <?php echo json_encode($top_auth); ?>;
        	let toppermlink = <?php echo json_encode($top_permlink); ?>;

        	steem.api.getContent(topauthor , toppermlink, function(err, res) {
        		console.log(res);

            steem.api.getContent(topauthor , toppermlink, function(err, res) {
                console.log(res);
                let metadata = JSON.parse(res.json_metadata);
                let img = new Image();
                if (typeof metadata.image === "string"){
                    img.src = metadata.image.replace("?","?");
                    }else img.src = metadata.image[0];
                    json_metadata = metadata;
                    let category = metadata.category;
                    if (category === undefined) { category = "dlike"; } else {category = metadata.category;}
                    let post_description = metadata.body;
                    let title = res.title;

                    $('#top_title').html(title);
                    $('.post-entry').html(category);
                    $("#top_img").attr("src", img.src);

        	});
    	</script>

    <? }
} else {
    echo "0 results";
}

?>