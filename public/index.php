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
</div>
<!--
<div class="modal fade" id="dlikem_maket" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-custom">
            <div class="modal-body ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="transfer-respond" style="padding: 10px 10px;">
                    <h2 style="font-size: 28px;font-weight: 600;padding-bottom: 30px;padding-top: 20px;">Buy DLIKEM Tokens</h4>
                    <p style="font-weight: 500;margin-bottom: 0px;padding: 0px;">
                        Buy DLIKEM tokens to stake, earn DLIEKR tokens reward.
                        40 miners get rewarded every hour!
                    </p><br>
                    <center>
                    <button class="btn btn-danger" style="padding: 12px 25px;font-weight: 600;font-size: 18px;">Limited Tokens For Sale</button>
                    <p style="padding-top: 7px;">Sale is live on <a href="https://steem-engine.com/?p=market&t=DLIKEM" target="_blank"><b>STEEM Engine Market</b></a></p>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<?php include('template/modals/modal.php'); ?>    
<?php include('template/footer.php'); ?>
<script type="text/javascript">
    $( document ).ready(function() {    
        $('#loadings').delay(6000).fadeOut('slow');

        $(window).on('load',function(){
            $('#dlikem_maket').modal('show');
        });
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