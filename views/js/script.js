jQuery(document).ready(function ($) {

    var slideExtraHeight = 80;
    var wrapperPaddingLeft = 50;
    var wrapperPaddingRight = 50;
    var slideItem = 3;
    var spead = 500;
    var slideMargin = 20;
    var sliderWraper = $('#wrap-sh-slider').width();

    var sliderLi = $('.sh-slider ul li');
    var sliderUl = $('.sh-slider ul');
    var slideCount = sliderLi.length;

    var slideWidth = (sliderWraper -  wrapperPaddingLeft - wrapperPaddingRight);
    var slideUlWidth = (slideWidth / slideItem) * slideCount * slideMargin - slideMargin;


    sliderUl.css(
        {
            width: slideUlWidth,
            marginLeft: - slideWidth / slideItem
        }
    );
    var slideHeight = sliderLi.height();
    sliderLi.css(
        {
            width: slideWidth / slideItem,
            height: slideHeight,
            marginRight: slideMargin
        }
    );
    $('.sh-slider ul li:last-child').prependTo('.sh-slider ul');

    $('.sh-slider').css(
        {
            width: slideWidth + 2 * slideMargin,
            height: slideHeight,
            paddingTop: slideExtraHeight / 2,
            paddingBottom: slideExtraHeight / 2
        }
    );

    $('.sh-slider ul li:first-child').next().next().animate(
        {
            height:slideHeight + slideExtraHeight / 2,
            marginTop: -slideExtraHeight / 4,
            marginLeft:-slideMargin,
            marginRight:0,
            zIndex: 11
        },spead
    );
    removeShadow($('.sh-slider ul li:first-child'));
    removeShadow($('.sh-slider ul li:first-child').next().next().next().next());

    /**
     * Move left
     */
    function moveLeft() {
        setShadow(sliderLi);
        $('.sh-slider ul li:first-child').next().animate(
            {
                height:slideHeight + slideExtraHeight / 2,
                marginTop: -slideExtraHeight / 4,
                marginLeft:-slideMargin,
                marginRight:0, zIndex: 11
            },spead
        );

        $('.sh-slider ul li:first-child').next().next().animate(
            {
                height:slideHeight,
                marginTop:0, marginLeft: 0,
                marginRight: slideMargin,
                zIndex: 1
            },spead
        );

        sliderUl.stop().animate({
            left: + slideWidth / slideItem
        }, spead, function () {
            $('.sh-slider ul li:last-child').prependTo('.sh-slider ul');
            $('.sh-slider ul').css('left', '');
        });


        removeShadow($('.sh-slider ul li:nth-last-child(1)'));
        removeShadow($('.sh-slider ul li:first-child').next().next().next());
    }

    /**
     * Move right
     */
    function moveRight() {
        setShadow(sliderLi);
        if (slideCount % 2 === 0) {
            var prev1 = $('.sh-slider ul li:last-child').prev().prev();
            var prev2 = $('.sh-slider ul li:last-child').prev().prev().prev();
            var prev3 = $('.sh-slider ul li:last-child').prev().prev().prev().prev();
        } else {
            var prev1 = $('.sh-slider ul li:last-child').prev();
            var prev2 = $('.sh-slider ul li:last-child').prev().prev();
            var prev3 = $('.sh-slider ul li:last-child').prev().prev().prev();

        }
        prev1.stop().animate(
            {
                height:slideHeight + slideExtraHeight / 2,
                marginTop: -slideExtraHeight / 4,
                marginLeft:-slideMargin,
                marginRight:0,
                zIndex: 11
            },spead
        );
        prev2.stop().animate(
            {
                height:slideHeight,
                marginTop:0,
                marginLeft: 0,
                marginRight: slideMargin,
                zIndex: 1
            },spead
        );
        sliderUl.stop().animate({
            left: - slideWidth / slideItem
        }, spead, function () {
            $('.sh-slider ul li:first-child').appendTo('.sh-slider ul');
            sliderUl.css('left', '');
        });

        removeShadow(prev3.prev());
        removeShadow(prev3);
    }

    function setShadow(elem) {
        var shadowValue = '#2d10cc59 0px 10px 20px';
        $(elem).css(
            {
                '-webkit-box-shadow' : shadowValue,
                '-moz-box-shadow' : shadowValue,
                'box-shadow' : shadowValue
            }
        );
    }

    function removeShadow(elem) {
        $(elem).css(
            {
                '-webkit-box-shadow' : 'none',
                '-moz-box-shadow' : 'none',
                'box-shadow' : 'none'
            }
        );
    }

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});

