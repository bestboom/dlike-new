$(document).ready(function(){

	let $tag, $limit, content = "#content";
    let query = {
        tag: "dlike",
        limit: 84,
    };

    steem.api.getDiscussionsByCreated(query, function (err, res) {
    	res.forEach(($post, i) => {

    		let metadata;
    		if ($post.json_metadata && $post.json_metadata.length > 0){
    			metadata = JSON.parse($post.json_metadata);
    		}

    		if(metadata && metadata.community == "dlike"){

    			getTotalcomments($post.author,$post.permlink);

    			// get image here
    			let img = new Image();
                if (typeof metadata.image === "string") {
                    if (metadata.image.indexOf("https://dlike") >= 0){
                        img.src = metadata.image.replace("?","%3f");
                    }else{
                         img.src = metadata.image;
                    }
                } else {
                    if (!metadata.image || metadata.image[0] === undefined) {
                        img.src = "https://dlike.io/images/default-img.jpg";
                    } else {
                        img.src = metadata.image[0];
                    }
                }

                //get time
                let activeDate = moment.utc($post.created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();

                //get meta tags
                let metatags = metadata.tags.map(function (meta) { if (meta) return '<a href="https://dlike.io/search/' + meta + '" target="_self"> #' + meta + ' </a>' });

                //Get the body
                let body;
                if($post && $post.body && $post.body != undefined){
                    try {
                        body = $post.body;
                        body = body.split(/\n\n#####\n\n/);
                        body = body[1];
                        body = body.replace(/#([^\s]*)/g,'');
                        //body = $post.body.replace(/<(.|\n)*?>/g, '');
                    }catch(err) {
                        body = "";
                    }
                }else{
                    body = "";
                }

                //image or youtube
                let thumbnail = '<img src="' + img.src + '" alt="' + $post.title + '" class="card-img-top img-fluid">';
                let url = new URL(metadata.url);
                	var youtubeAnchorTagVariableClass = '';
					if(url.hostname == 'www.youtube.com' || url.hostname == 'youtube.com' || url.hostname == 'youtu.be' || url.hostname == 'www.youtu.be'){
						//alert(url);
						youtubeAnchorTagVariableClass = 'youtubeAnchorTagVariableClass_' + i;
						if(url.search != ''){
							let query = url.search.substr(1); //remove ? from begning
							query = query.split('&')
							for (i in query){
								let splited = query[i].split('=');
								if(splited[0] == 'v'){
									thumbnail = '<iframe src="https://www.youtube.com/embed/' + splited[1] + '" class="card-img-top img-fluid" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe>';
								}
							}
						}else{
							thumbnail = '<iframe src="https://www.youtube.com/embed/' + url.pathname + '" class="card-img-top img-fluid" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe>';
						}
					} 

				//check comments
				function getTotalcomments(thisAutor,thisPermlink){
    			//Conting the comments (just the dlike ones)
       				steem.api.getContentReplies(thisAutor,thisPermlink, function(err, result) {
                		let totalDlikeComments = 0;  
                		result.forEach(comment =>{
                        	let metadata;
                        		if (comment.json_metadata && comment.json_metadata.length > 0){
                            		metadata = JSON.parse(comment.json_metadata);
                        		}
                        		if(metadata && metadata.community == "dlike"){
                            		totalDlikeComments +=1;    
                        		}
                		});
           				$("#DlikeComments" + thisPermlink + thisAutor).html(totalDlikeComments);
        			});  
    			}
	

                //start posts here
                $(content).append('<div class="col-lg-4 col-md-6">\n' +
                	'\n' +
                	'<article class="post-style-two">\n' +
                	'\n' +
                	'<div class="post-contnet-wrap-top">\n' +
                		'\n' +
                            '<div class="post-footer">\n' +
                            '\n' +
                                '<div class="post-author-block">\n' +
                                '\n' +
                                    '<div class="author-thumb"><a href="#"><img src="https://steemitimages.com/u/' + $post.author + '/avatar" alt="img" class="img-responsive"></a></div>\n' +
                                    '\n' +
                                    '<div class="author-info">\n' +
                                    '\n' +
                                        '<h5><a href="#">' + $post.author + '</a><div class="time">' + activeDate + '</div></h5>\n' +
                                    '\n' +    
                                    '</div>\n' +
                                '\n' + 
                                '</div>\n' +
                                '\n' +
                                '<div class="post-comments"><span class="post-meta">Cryptocurrency</span></div>\n' +
                                '\n' +
                            '</div>\n' +
                            '\n' +
                        '</div>\n' + 
                        '\n' +
                        '<div class="post-thumb"><a href="#">' + thumbnail + '</a></div>\n' + 
                        '\n' +
                        '<div class="post-contnet-wrap">\n' +
                        	'\n' +
                            '<div class="hov-wrap"><a class="hov-txt" data-toggle="modal" data-target="" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><span id="hov-num">0</span></a><div><img src="./images/post/dlike-hover.png" alt="img" class="img-responsive dlike-hov"></div></div>\n' +
                            '\n' +
                            '<h4 class="post-title"><a href="#">' + $post.title + '</a></h4>\n' +
                            '\n' +
                            '<p class="post-entry post-tags">' + metatags + '</p>\n' +
                            '\n' +
                            '<div class="post-footer">\n' +
                                '<div class="post-author-block">\n' +
                                    '<div class="author-info"><i class="fas fa-dollar-sign"></i><span>&nbsp;' + $post.pending_payout_value.substr(0, 4) + '</span> | <i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+$post.permlink +$post.author +'">0</span></div>\n' +
                                '</div>\n' +
                                '<div class="post-comments"><i class="fas fa-chevron-circle-up"></i><span>&nbsp; | ' + $post.active_votes.length + ' Votes</span></div>\n' +
                            '</div>\n' +
                        '</div>\n' +
                '</article></div>');

    		}

    	});

    });

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
                    $("#top_img").attr("src", img.src).show();

            });
});
