$(document).ready(function () {
    var hidWidth;var scrollBarWidths_2 = 40;
    var widthOfList_2 = function(){var itemsWidth = 0;
        $('.list-2 a').each(function(){var itemWidth = $(this).outerWidth();itemsWidth+=itemWidth;});
        return itemsWidth;};
    var widthOfHidden_2 = function(){return (($('.wrapper').outerWidth())-widthOfList_2()-getLeftPosi_2())-scrollBarWidths_2;};
    var getLeftPosi_2 = function(){return $('.list-2').position().left;};
    var reAdjust_2 = function(){
        if (($('.wrapper').outerWidth()) < widthOfList_2()) {$('.scroller-right-2').show().css('display', 'flex');}else {}
        if (getLeftPosi_2()<0) {$('.scroller-left-2').show().css('display', 'flex');
        }else {$('.item').animate({left:"-="+getLeftPosi_2()+"px"},'slow');}
    }
    reAdjust_2();
    $(window).on('resize',function(e){reAdjust_2();});
    $('.scroller-right-2').click(function() {$('.scroller-left-2').fadeIn('slow');
        if(getLeftPosi_2() < -672){$('.scroller-right-2').fadeOut('slow');}
        $('.list-2').animate({left:"+="+"-112px"},'slow',function(){});
    });
    $('.scroller-left-2').click(function() {
        $('.scroller-right-2').fadeIn('slow');$('.scroller-left-2').fadeOut('slow');
        $('.list-2').animate({left:"-="+getLeftPosi_2()+"px"},'slow',function(){});
    });
});