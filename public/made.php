<?php include('template/header5.php');
$urlImage = 'https://i.postimg.cc/d0Vf2w92/hummingbird.jpg';
$description = 'This is a test on steem posting';
$body = "<center><img src='" . $urlImage . "' alt='New Share' /></center>  \n\n#####\n\n '" . $description . "'  \n\n#####\n\n <center><br><a href='https://steemit.com/'>Posting Test</a><hr><br>";

include('template/footer.php'); ?>
<script type="text/javascript">
	var urlImage = 'https://i.postimg.cc/d0Vf2w92/hummingbird.jpg';
	var ext_url = 'https://steemit.com';
	var category = 'blockchain';
	var tags = "new-test blockchain";
	var tags = tags.replace(/([a-zA-Z0-9-]+)/g, "\"$1\"");
	var tags = tags.replace(/\s+/g, ', ').toLowerCase();
	var post_tags = '["hive-116221", "dlike", '+ tags +']';
	var meta_tags = JSON.parse(post_tags);

	var rewards = "2";
	if(rewards == '1'){
	    var max_accepted_payout = "900.000 SBD";
	    var percent_steem_dollars = 10000;
	} else if(rewards == '2'){
        var max_accepted_payout = "900.000 SBD";
        var percent_steem_dollars = 0;
    } else if(rewards == '3'){
        var max_accepted_payout = '0.000 SBD';
        var percent_steem_dollars = 10000;
    } else {
        var max_accepted_payout = '900.000 SBD';
		var percent_steem_dollars = 10000;
    }
    console.log(max_accepted_payout);

	console.log(username);
	var parentAuthor = '';
	var parentPermlink = 'test';
	var author = username;
	//var permlink = 'a-new-steem-test-6';
	var title = "posting test no 11";
	var permlink = title.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
	var body = '<center><img src="https://i.postimg.cc/d0Vf2w92/hummingbird.jpg" alt="New Share" /></center><br><p>This is an other test post with rewards check</p><p>This is (check <a href="https://www.steemit.com">steemit</a>) , Now content can also be published.&nbsp;</p><br><center><br><a href="https://steemit.com/">Posting Test</a><hr><br>';
	var post_body = body.replace(/[\u2018\u2019]/g, "'").replace(/[\u201C\u201D]/g, '"');
	//var max_accepted_payout = max_accepted_payout;
    //var percent_steem_dollars = percent_steem_dollars;
	var jsonMetadata = {
	    "tags": meta_tags,
	    "app": "steemit/0.1",
	    "community": "steem",
    	"format": "html",
    	"image": urlImage,
    	"url": ext_url,
    	"type": "share",
    	"body": post_body,
    	"category": category
	};
	console.log(jsonMetadata)
	/*var beneficiaries = [
                    {
                        "account": "steem",
                        "weight": 1000
                    },
                    {
                        "account": "steemit",
                        "weight": 200
                    }
            ];
	console.log(beneficiaries);*/


	api.comment(parentAuthor, parentPermlink, author, permlink, title, body, jsonMetadata, function (err, res) {
  		console.log(err, res)
	});
</script>