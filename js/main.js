( function( factory ) {
    if ( typeof define === "function" && define.amd ) {

        // AMD. Register as an anonymous module.
        define( [ "../widgets/datepicker" ], factory );
    } else {

        // Browser globals
        factory( jQuery.datepicker );
    }
} );

(function ($) {
    var mobile = $(window).width() < 992,
        rtl = $('html').attr('dir') === 'rtl';
    $('#shipping_method li').each(function(){
        var price=$(this).find('label .woocommerce-Price-amount.amount').text();
        var text=$(this).find('label').text();
        var val=text.replace(price,'');
        var val=val.replace(': ','');
        $('#billing_shipping_my').append('<option>'+val+'</option>');
    });

    if($('.variations select').length){
        var str = $('.variations select').find("option:selected").text();
        var to = str.split('(');

        var from = to[1].split(')');
        $('.price_product ').html(from[0]);
    }

    $('.variations select').change(function(){
        var str = $(this).find("option:selected").text();
        var to = str.split('(');

        var from = to[1].split(')');
        $('.price_product ').html(from[0]);
    });


    $('#sup_product').click(function(e){
        e.preventDefault();
        $('.hidden_product').slideToggle( "slow", function() {
            var target = '#hidden_product';
            $('html, body').animate({
                scrollTop: $(target).offset().top +50
            }, 500);
            return false;
        });
    })


    function func() {
        $('.add-to-cart').removeAttr('tabindex');
    }

    setTimeout(func, 2000);

    $(document).on('click', '.single_add_to_cart_button', function (e) {
        setTimeout(func, 2000);
    });
    $(document).on('click', '.remove ', function (e) {
        setTimeout(func, 4000);
    });
    $('#popup_order').click(function(event){
        event.preventDefault();
        $('#order_modal').css('display','block');
    });
    $('.Close_modal_order').click(function(event){
        event.preventDefault();
        $('#order_modal').css('display','none');
    });
    $('#popup_order').click(function(){
        $('#billing_date').val($('#time_order').val());
        $('#billing_time').val($('#date_order').val());
    });

    var tomorrow = new Date();
    var date = new Date(tomorrow.setDate(tomorrow.getDate() + 1));

    var formatted = $.datepicker.formatDate("dd-mm-yy",date);




    $( "#date_order" ).datepicker({
        dateFormat: "dd-mm-yy",
        minDate: formatted,
        beforeShowDay: nonWorkingDates,
        closeText: "סגור",
        prevText: "&#x3C;הקודם",
        nextText: "הבא&#x3E;",
        currentText: "היום",
        monthNames: [ "ינואר","פברואר","מרץ","אפריל","מאי","יוני",
            "יולי","אוגוסט","ספטמבר","אוקטובר","נובמבר","דצמבר" ],
        monthNamesShort: [ "ינו","פבר","מרץ","אפר","מאי","יוני",
            "יולי","אוג","ספט","אוק","נוב","דצמ" ],
        dayNames: [ "ראשון","שני","שלישי","רביעי","חמישי","שישי","שבת" ],
        dayNamesShort: [ "א'","ב'","ג'","ד'","ה'","ו'","שבת" ],
        dayNamesMin: [ "א'","ב'","ג'","ד'","ה'","ו'","שבת" ],
        // weekHeader: "Wk",
        // dateFormat: "dd/mm/yy",
        firstDay: 0,
        isRTL: true,
        // showMonthAfterYear: false,
        // yearSuffix: ""
    });






    var disabledDays = [
        '1.1.2018',
        '2.1.2018',
        '20.2.2018',
        '19.1.2018',
        '1.8.2018',
        '15.8.2018',
        '1.11.2018',
        '8.12.2018',
        '25.12.2018',
        '26.12.2018'
    ];
    function nonWorkingDates(date){
        var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
        var closedDates = [[7, 29, 2009], [8, 25, 2010]];
        var closedDays = [[Saturday]];
        for (var i = 0; i < closedDays.length; i++) {
            if (day == closedDays[i][0]) {
                return [false];
            }

        }

        for (i = 0; i < closedDates.length; i++) {
            if (date.getMonth() == closedDates[i][0] - 1 &&
                date.getDate() == closedDates[i][1] &&
                date.getFullYear() == closedDates[i][2]) {
                return [false];
            }
        }

        return [true];
    }


    $('#shipping_method li').each(function(){
        var price=$(this).find('label .woocommerce-Price-amount.amount').text();

        if($(this).find('input').is(':checked')){
            $('.shipping-price').html('<div class="shipping-price-wrap">'+price+'</div>');
            var shipping=$(this).find('label').text();

            $('#billing_shipping_my option').each(function(){
                if($(this).text()+': '+price==shipping) {
                    $('#billing_shipping_my option').removeAttr('selected');
                    $(this).attr('selected','selected');
                }
            });
        }
    });

    $(document).on('change' , '#billing_shipping_my' , function () {
        var val=$(this).val();
        $('#shipping_method li').each(function(){
            var price=$(this).find('label .woocommerce-Price-amount.amount').text();
            if($(this).find('label').text()==val+': '+price || $(this).find('label').text()==val){
                $(this).find('input').trigger('click');
                $('.shipping-price').html('<div class="shipping-price-wrap">'+price+'</div>');
            }
        });

    });
    $(document).on('click' , '.increase-number-input' , function () {
        var input = $(this).prev();
        if(!input.val()) {
            input = $(this).closest('.number-input').find('input');
        }
        var	max = parseInt(input.attr('max'));
        var val = parseInt(input.val());
        $(this).closest('form').find('.add-to-cart').attr('data-quantity',val);
        if(!max){
            max=1000;
        }
        if (val < max){
            input.val(val+1);
            $(this).closest('form').find('.add-to-cart').attr('data-quantity',val+1);
        }
        $('.update_cart').removeAttr('disabled');
        $('.update_cart').trigger('click');
        setTimeout(func, 6000);

    });
    $(document).on('click' , '.reduce-number-input' , function () {
        var input = $(this).next();
        if(!input.val()) {
            input = $(this).closest('.number-input').find('input');
        }
        var	min = parseInt(input.attr('min'));
        if(!min){
            min=1;
        }
        var val = parseInt(input.val());
        $(this).closest('form').find('.add-to-cart').attr('data-quantity',val);
        if (val > min){
            input.val(val-1);
            $(this).closest('form').find('.add-to-cart').attr('data-quantity',val-1);
        }
        $('.update_cart').removeAttr('disabled');
        $('.update_cart').trigger('click');
        setTimeout(func, 6000);
    });

    function func() {

        $.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                'action': 'loadminicart',
            },
            success: function (data) {
                $('.cart-contents span.count').html(data);
            },
        });
    }

    $('body').on('click', '.add-to-cart', function () {


        setTimeout(func, 4000);


    });
    $('body').on('click', '.cart_product', function () {
        $('.woocommerce-cart-form').addClass('processing');
        function func_update() {
            var href = window.location.href
            $.get(href, function (data) {
                $('.woocommerce-cart-form').html($(data).find('.woocommerce-cart-form > *'));
                $('.woocommerce-cart-form').removeClass('processing');
                $(data).filter('script').each(function () {
                    if ((this.text || this.textContent || this.innerHTML).indexOf("document.write") >= 0) {
                        return;
                    }
                    $.globalEval(this.text || this.textContent || this.innerHTML || '');
                });


            }, "html");

            func();
        }

        setTimeout(func_update, 1000);


    });


    $('.call-menu').on('click' , function () {
        $(this).toggleClass('open');
        $('.menu-main-container').slideToggle()
    })
    $('.fixed-categories .item').on('click' , function (e) {
        e.preventDefault()
        var target = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(target).offset().top - 200
        }, 500);
        return false;
    })
    $('.fixed-btn .show-hidden-content').on('click' , function () {
        $(this).next().toggleClass('open')
    })
    $('.show-category-list').on('click' , function () {
        $('.categories-list').slideToggle()
    })
    $('.accordeon .title').on('click' , function () {
        $(this).parent().toggleClass('open').find('.content').slideToggle()
    });
    $('.go-to-top').on('click' , function () {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
    })

    $('.main-slider').slick({
        rtl: rtl,
        arrows: false,
        fade: true,
        speed: 1200,
        infinite: true,
        cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        autoplay: true,
        autoplaySpeed: 10000
    })
    $('.hp-gallery-slider').slick({
        rtl: rtl,
        variableWidth: true,
        centerMode: true,
        focusOnSelect: true,
        autoplay: true,
        autoplaySpeed: 10000,
        speed: 1000,
        arrows: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                centerMode: false,
            }
        }]
    });
    $('.event-slider').slick({
        rtl: rtl,
        responsive: [{
            breakpoint: 768,
            settings: {
                arrows: false,
                dots: true
            }
        }]
    });
    $('.product-img-slider').slick({
        rtl: rtl,
        speed: 1000,
        responsive: [{
            breakpoint: 768,
            settings: {
                arrows: false,
                dots: true
            }
        }]
    });
    $('.quotes-slider').slick({
        rtl: rtl,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 7000,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
            }
        }]
    });

    if (mobile){
        $('.steps-list').slick({
            rtl: rtl,
            arrows: false,
            dots: true,
        });
        $('.offers-list').slick({
            rtl: rtl,
            arrows: false,
            dots: true,
        });
    }
    else{

    }
    if($(window).width() > 767)
        $('.related-products-slider').slick({
            rtl: rtl,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            }]
        });

    $(window).on('load' , function () {
        if($('.categories-section.fixed-categories').length > 0 && !mobile){
            var catList = $('.categories-section.fixed-categories')
            catList.height(catList.height());
            $(window).on('scroll' , function () {
                var st = $(this).scrollTop();
                if (st > catList.offset().top + catList.outerHeight()) {
                    catList.addClass('sticky')
                }
                else{
                    catList.removeClass('sticky')
                }
            })
        }
    });
    $(window).on('scroll' , function () {
        if ($(this).scrollTop() > 200){
            $('.go-to-top').fadeIn()
        }
        else{
            $('.go-to-top').fadeOut()
        }
    })

})(jQuery)
































