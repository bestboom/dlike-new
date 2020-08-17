<?php include('template/header7.php');?>
</div><!-- sub-header -->
<div class="latest-post-section" style="min-height:80vh;padding: 70px 0px 60px 0px;">
    <div class="container">
        <div class="row" id="contents">
        </div>
    </div>  

    <div class="container" style="padding-top:0px;">
        <p>Dlike is a social sharing dapp (decentralized application) built on steem blockchain where you can share any news, story or tips which you consider worth sharing with community and if community likes your sharing then you get rewarded in the form of upvotes.</p>
        <p>Dlike has 2 types of upvotes namely STEEM and DLIKER. Steem is the native token for steem blockchain while DLIKER is the native token for Dlike platform which is built on steem-engine exchange and is independently trade-able. </p>
        <p>On dlike, we have different categories in which you can share according to your liking. Mainly these categories are health, business, food, cryptocurrency, sports, news, technology and general. You can share these news, stories and tips from any popular website or even from your personal blog but being an informative source, we do not allow personal promotion like selfies and other such content. So always share content that is information oriented and is useful as a source of information for all community members across the globe.</p>
        <p>As compared to conventional social sharing sites like Reddit and Pinterest where you give your time for sharing and doesn’t get any part in earnings, here on dlike, you are rewarded for your time and efforts in the form of crypto earnings (steem and dliker) upvotes. Another advantage is of being censorship free platform as on dlike your content is saved on blockchain (steem) which is not editable or even remove able so there is no penalty in the form of censorship on dlike platform.</p>
        <p>Dlike is building its own economy where any steem users can delegate his extra steem power to dlike which we use to upvote posts on dlike and the beneficiary reward out of this voting goes to delegators which was earlier in the form of steem and now in the form of DLIKER token buy back on steem engine exchange. So we are trying to build a system where very participant gets benefited as per his share in the platform and a solid economic base is being built in co-operation with community members.</p>
        <p>We are also offering daily rewards for all dlike users in the form DLIKE tokens. These rewards are generated on the basis of user activities across the platform. These activities account the performance of user posts. Some of the basic metrics of this reward system includes the views and likes on the posts. In addition to this, users can invite new users which generate daily points for them from each of the post shared by their affiliates. In the long run, this reward system will be the main source of earning DLIKE tokens on dlike as it will be the major utility on dlike platform.</p>
        <p>If you are looking for any help regarding dlike platform, sharing on dlike or anything related to dlike tokens, then always feel free to reach us on dlike discord channel.</p>
    </div>
</div>
<?php include('template/modals/modal.php'); ?>    
<?php include('template/dlike_footer.php'); ?>
<script type="text/javascript">
    $( document ).ready(function() {    
        $('#loadings').delay(6000).fadeOut('slow');
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){   
    let $tag, $limit, content = "#contents";
    let query = {tag: "dlike",limit: 90,};
    steem.api.getDiscussionsByCreated(query, function (err, res) { res.forEach(($post, i) => {
        $post["vote_info"] = "";let metadata;
        if ($post.json_metadata && $post.json_metadata.length > 0){metadata = JSON.parse($post.json_metadata);}
        
        var currentPostNumber = i;var currentLikesDivElement = 'postLike_' + i;
        if(metadata && metadata.community == "dlike"){
            getTotalcomments($post.author,$post.permlink);
            // get image here
            let img = new Image();
            if (typeof metadata.image === "string") {if (metadata.image.indexOf("https://dlike") >= 0){img.src = metadata.image.replace("?","%3f");}else{img.src = metadata.image;}
            } else {if (!metadata.image || metadata.image[0] === undefined) {img.src = "https://dlike.io/images/default-img.jpg";} else {img.src = metadata.image[0];}}

            //get time
            let activeDate = moment.utc($post.created + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();

            //get meta tags
            let steemTags = metadata.tags; let dlikeTags = steemTags.slice(2);
            let metatags = dlikeTags.map(function (meta) { if (meta) return '#' + meta + ' '});
            let category = metadata.category; let category_link = category.toLowerCase(); let exturl = metadata.url;

            //Get the body
            let body; if($post&&$post.body&&null!=$post.body)try{body=$post.body,body=body.split(/\n\n#####\n\n/),body=body[1],body=body.replace(/#([^\s]*)/g,"")}catch(o){body=""}else body="";

            //image or youtube
            let thumbnail = '<img src="' + img.src + '" alt="' + $post.title + '" class="card-img-top">';

            var getLocation = function(href) {var l = document.createElement("a");l.href = href;return l;};
            var url = getLocation(metadata.url);var youtubeAnchorTagVariableClass = '';
            if("www.youtube.com"==url.hostname||"youtube.com"==url.hostname||"youtu.be"==url.hostname||"www.youtu.be"==url.hostname)if(youtubeAnchorTagVariableClass="youtubeAnchorTagVariableClass_"+i,""!=url.search){let e=url.search.substr(1);for(i in e=e.split("&")){let l=e[i].split("=");"v"==l[0]&&(thumbnail='<iframe src="https://www.youtube.com/embed/'+l[1]+'" class="card-img-top" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe>')}}else thumbnail='<iframe src="https://www.youtube.com/embed/'+url.pathname+'" class="card-img-top" style="overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen></iframe>';

            //check comments
            function getTotalcomments(t,e){steem.api.getContentReplies(t,e,function(a,n){let m=0;n.forEach(t=>{let e;t.json_metadata&&t.json_metadata.length>0&&(e=JSON.parse(t.json_metadata)),e&&"dlike"==e.community&&(m+=1)}),$("#DlikeComments"+e+t).html(m)})}

            var adduserhtml = ""; var mylabel = $post.permlink +$post.author;var newValue = mylabel.replace('.', '');
            adduserhtml += '<a style="color:white;" class="userstatus_icon'+newValue+'"><i class="fa fa-check-circle" class="user_status'+newValue +'"></i></a>';

            //start posts here
            $(content).append('<div class="col-lg-4 col-md-6 postsMainDiv mainDiv'+ currentLikesDivElement +'" postLikes="0" postNumber="'+ currentPostNumber +'">\n' +
                '\n' +
                '<article class="post-style-two">\n' +
                '\n' +
                '<div class="post-contnet-wrap-top">\n' +
                '\n' +
                '<div class="post-footer">\n' +
                '\n' +
                '<div class="post-author-block">\n' +
                '\n' +
                '<div class="author-thumb"><a href="/@' + $post.author + '"><img src="https://steemitimages.com/u/' + $post.author + '/avatar" alt="img" class="img-responsive"></a></div>\n' +
                '\n' +
                '<div class="author-info">\n' +
                '\n' +
                '<h5><a href="https://steemit.com/@' + $post.author + '" target="_blank">' + $post.author  + "&nbsp;" +adduserhtml +'</a><div class="time">' + activeDate + '</div></h5>\n' +
                '\n' +    
                '</div></div>\n' +
                '\n' +
                '<div class="post-comments post-catg"><span class="post-meta"><b>' + category + '</b></span></div>\n' +
                '\n' +
                '</div></div>\n' +
                '\n' +
                '<div class="post-thumb img-fluid"><a href="/post/@' + $post.author + '/' + $post.permlink + '">' + thumbnail + '</a></div>\n' + 
                '\n' +
                '<div class="post-contnet-wrap">\n' +
                '\n' +
                '<h4 class="post-title single_title"><a href="/post/@' + $post.author + '/' + $post.permlink + '">' + $post.title + '</a></h4>\n' +
                '\n' +
                '<p class="post-entry post-tags">' + metatags + '</p>\n' +
                '\n' +
                '<div class="post-footer">\n' +
                '<div class="post-author-block">\n' +
                '<div class="author-info"><i class="fas fa-dollar-sign"></i><span>&nbsp;' + $post.pending_payout_value.substr(0, 4) + '</span> <b>+</b> <span id="se_token'+newValue +'" data-popover="true" data-html="true" data-content="">0</span> <b>DLIKER</b></div>\n' +
                '</div>\n' +
                '<div class="post-comments"><a class="upvoting" data-toggle="modal" data-target="#upvoteModal" data-permlink="' + $post.permlink + '" data-author="' + $post.author + '"><i class="fas fa-chevron-circle-up" id="vote_icon'+newValue+'"></i></a><span>&nbsp;' + $post.active_votes.length + '</span>&nbsp; | &nbsp;<i class="fas fa-comments"></i>&nbsp;<span id="DlikeComments'+$post.permlink +$post.author +'">0</span></div>\n' +
                '</div></div>\n' +
            '</article></div>');
            let author = $post.author;let permlink = $post.permlink;                
            // dliker
            $.getJSON("https://scot-api.steem-engine.com/@"+$post.author+"/"+$post.permlink,function(e){let t=e.DLIKER.pending_token/1e3;$("#se_token"+newValue).html(t);let n=e.DLIKER.active_votes,o=e.DLIKER.vote_rshares;if(n===Array)var s=n;else s=[];if(n!==Array)s=[];0===(s=n).length&&($post.vote_info="<center><red>No Upvotes Yet!</red></center>");for(let e=0;e<s.length;e++)if(s[e].weight>0){let n=(s[e].rshares/o*t).toFixed(3),r=s[e].percent/1e4*100;r=parseInt(r);let a=s[e].voter;if(e>0&&$("#se_token"+newValue).css("cursor","pointer"),$post.vote_info+='<li style="list-style:none;"><span style="color:#c51d24;"><a> @'+a+"</a></span>&nbsp;<span>("+r+'%)</span>&nbsp;&nbsp;<span style="float:right;"><i>'+n+"</i></span></li>",16==e){let e=s.length-15;$post.vote_info+="... and "+e+" more upvotes.";break}}$("#se_token"+newValue).attr("data-content",$post.vote_info)});
            //user-pro status
            $.ajax({type:"POST",url:"/helper/getuserpoststatus.php",data:{author:author},dataType:"json",success:function(s){var t=(permlink+author).replace(".","");if("OK"==s.status){if("3"==s.setstatus){$(".userstatus_icon"+t).css({color:"red"});var e="PRO User"}$(".userstatus_icon"+t).hover(function(){toastr.success(e)})}else $(".userstatus_icon"+t).remove()}});
            steem.api.getActiveVotes($post.author,$post.permlink,function(e,o){if(o===Array)var t=o;else t=[];t!==Array&&(t=[]);t=o;for(let e=0;e<t.length;e++)t[e].voter==username&&($("#vote_icon"+newValue).css("color","RED"),$("#vote_icon"+newValue).click(function(){return!1}),$("#vote_icon"+newValue).hover(function(){toastr.error("hmm... Already Upvoted")}))});
            }
        });
    });
$('body').popover({ selector: '[data-popover]', trigger: 'click hover', placement: 'auto', delay: {show: 50, hide: 400}});
});
</script>