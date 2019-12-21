<?php include('template/header5.php');?>
</div><!-- sub-header -->
<?php
$posttags = "SELECT tagname, count(*) FROM posttags WHERE updated_at > DATE_SUB( NOW(), INTERVAL 24 HOUR) Group by tagname order by count(*) DESC Limit 15";
    $posttags_r = $conn->query($posttags);
    if ($posttags_r->num_rows > 0) {
        $trending_html = '';
        $counter = 0; 
            while($row = $posttags_r->fetch_assoc()) {
                if (!empty($row['tagname']) && strpos($row['tagname'], 'dlike') === false) {
                    $trending_html .= '<a class="nav-item nav-link" href="/tags/'.$row['tagname'].'">'.strtoupper($row['tagname']).'&nbsp;<button type="button" class="close closeBtn" aria-label="Close"><span aria-hidden="true"></span></button></a>';
                    ++$counter;
                }  
            }
    } else {
        $trending_html = '';
    }
?> 
<div class="latest-post-section" style="min-height:80vh;padding: 70px 0 60px 0;">
    <div class="container">
        <div class="row" style="background:  #f3f4f5;padding-top: 31px;margin-bottom: 20px;">
            <div class="col-lg-12 col-md-12 " style="margin-bottom: 10px">
                <div class="p-0">
                    <div class="container p-0">
                        <div class="row">
                            <div class="w-100 p-3" style="padding-top: 0 !important;padding-bottom: 0 !important;">
                                <div class="scroller scroller-left mt-2"><i class="fa fa-chevron-left"></i></div>
                                <div class="scroller scroller-right mt-2"><i class="fa fa-chevron-right"></i></div>
                                <div class="wrapper">
                                    <nav class="nav nav-tabs list mt-2" id="myTab" role="tablist">
                                        <a class="nav-item nav-link active" id="public-chat-tab" data-toggle="tab" href="#publicChat" role="tab" aria-controls="public" aria-expanded="true" style="font-weight: 900">Trending now ></a>
                                        <?php echo $trending_html;?>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!-- testimonial-section -->
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row  align-items-center h-100 post_select">
            <div class="row col-md-3 justify-content-center">
                <h4 class="lab_post orderByLatest activeOrderBy">Latest</h4>
                <h4 class="lab_post orderByTopRated">Top Rated</h4>
            </div>
            <div class="col-md-9 lay">&nbsp;</div>
        </div>
        <div id="loadings"><img src="/images/loader.svg" width="100"></div>
        <div class="row" id="content">
        </div>
    </div>

    <div class="container" style="padding-top:40px;">
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
<?php include('template/footer.php'); ?>
<script type="text/javascript">
    $( document ).ready(function() {    
        $('#loadings').delay(6000).fadeOut('slow');

        //$(window).on('load',function(){
        //    $('#dlikem_maket').modal('show');
        //});
    });
    var hidWidth;
    var scrollBarWidths = 40;

    var widthOfList = function(){
        var itemsWidth = 0;
        $('.list a').each(function(){
            var itemWidth = $(this).outerWidth();
            itemsWidth+=itemWidth;
        });
        return itemsWidth;
    };

    var widthOfHidden = function(){
        return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
    };

    var getLeftPosi = function(){
        return $('.list').position().left;
    };

    var reAdjust = function(){
        if (($('.wrapper').outerWidth()) < widthOfList()) {
            $('.scroller-right').show().css('display', 'flex');
        }
        else {
            //$('.scroller-right').hide();
        }

        if (getLeftPosi()<0) {
            $('.scroller-left').show().css('display', 'flex');
        }
        else {
            $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
            //$('.scroller-left').hide();
        }
    }

    reAdjust();

    $(window).on('resize',function(e){
        reAdjust();
    });

    $('.scroller-right').click(function() {
        $('.scroller-left').fadeIn('slow');
        //$('.scroller-right').fadeOut('slow');
        //console.log(getLeftPosi());
        if(getLeftPosi() < -672){ $('.scroller-right').fadeOut('slow');}
        $('.list').animate({left:"+="+"-112px"},'slow',function(){

        });
    });

    $('.scroller-left').click(function() {
        $('.scroller-right').fadeIn('slow');
        $('.scroller-left').fadeOut('slow');
        $('.list').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){
        });
    });
</script>