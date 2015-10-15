//****************************************************************************
// Предотвращает выполнение действия перехода по ссылке: href="#"
//****************************************************************************
jQuery(document).ready(function () {
    $('[href="#"]').click(function (e) {
        e.preventDefault();
    });
    $('.panel>.panel-heading a').click(function(){
        var idAccordionTab = $(this).attr('href');
        var classThis = $(this).parent().parent().attr('class');
        if(classThis == 'hidden-xs') {
            $('#accordion>.panel>.panel-heading').css('background-color', '#ffffff');
            $('#accordion>.panel>.panel-heading>.hidden-xs>h4').css('color', '#61b1c5');
            $('#accordion>.panel>.panel-heading>.hidden-xs>h4>a').css('background', 'url("/img/icons.png") -110px -110px');
        }
        else {
            $('#accordion>.panel>.panel-heading').css('background-color', '#ffffff');
            $('#accordion>.panel>.panel-heading>.visible-xs>h4>a').css('color', '#61b1c5');
        }
        if($(idAccordionTab).hasClass('in')) {
            if(classThis == 'hidden-xs') {
                $(this).parent().css('color', '#61b1c5');
                $(this).parent().parent().parent().css('background-color', '#ffffff');
                $(this).css('background', 'url("/img/icons.png") -110px -110px');
            }
            else {
                $(this).css('color', '#61b1c5');
                $(this).parent().parent().parent().css('background-color', '#ffffff');
            }
        }
        else {
            if(classThis == 'hidden-xs') {
                $(this).parent().css('color', '#ffffff');
                $(this).parent().parent().parent().css('background-color', '#61b1c5');
                $(this).css('background', 'url("/img/icons.png") -20px -110px');
            }
            else {
                $(this).css('color', '#ffffff');
                $(this).parent().parent().parent().css('background-color', '#61b1c5');
            }
        }
    });
    $('.answer-show').click(function(){
        $(this).parent().fadeOut("slow");
        $(this).parent().parent().next().slideDown("slow");
        $(this).parent().next().fadeIn("slow");
    });
    $('.answer-hidden').click(function(){
        $(this).parent().parent().slideUp("slow");
        $(this).parent().parent().prev().children('.question-button').fadeIn("slow");
        $(this).parent().parent().prev().children('.question-triagle').fadeOut("slow");

    });
    $('.seawolf-block .btn-7').click(function(){
        $('.how-it-works').slideDown('slow');
        $(this).addClass('disabled');
    });
    $('.how-close').click(function(){
        $('.how-it-works').slideUp('slow');
        $('.seawolf-block .btn-7').removeClass('disabled');
    });
    $('.input-group input').focus(function(){
        $(this).next('.input-group-addon').css('border-color', '#61b1c5');
    }).blur(function(){
        $(this).next('.input-group-addon').css('border-color', '#ccc');
    });
    $('.left-addon > input').focus(function(){
        $(this).prev().css('border-color', '#61b1c5');
    }).blur(function() {
        $(this).prev().css('border-color', '#ccc');
    });
    $('.main-select>.input-group-btn>ul').scrollator({
        zIndex: '10000'
    });
    $('.main-select>.input-group-btn>ul>li >a').click(function(){
        $(this).parent().parent().parent().prev('input').val($(this).html());
        if(this.id == "yesChild") {
            if($('#ageChild').hasClass('disabled')) {
                $('#ageChild').removeClass('disabled');
                $('#ageChild').children('input').removeAttr('disabled');
            }
        }
        if(this.id == "noChild") {
            if(!$('#ageChild').hasClass('disabled')) {
                $('#ageChild').addClass('disabled');
                $('#ageChild').children('input').attr('disabled', true);
            }
        }
    });
    $('#inputChild1').change(function(){
        if($(this).val() == "yesChild") {
            $('#inputNumberChild1').attr('disabled', false);
            $('#inputAgeChild1').attr('disabled', false);
        }
        if($(this).val() == "noChild") {
            $('#inputNumberChild1').attr('disabled', true);
            $('#inputAgeChild1').attr('disabled', true);
        }
    });
    $('#inputParticipationChildren').change(function(){
        if($(this).val() == "yes") {
            $('#ageChild').attr('disabled', false);
        }
        if($(this).val() == "no") {
            $('#ageChild').attr('disabled', true);
        }
    });
    $('#inputDiscountHot').change(function(){
        if($(this).val() == "yes") {
            $('#inputDiscountHotPercent').attr('disabled', false);
            $('#inputDiscountHotDate').attr('disabled', false);
        }
        if($(this).val() == "no") {
            $('#inputDiscountHotPercent').attr('disabled', true);
            $('#inputDiscountHotDate').attr('disabled', true);
        }
    });
    $('#filterXS').click(function(){
       $('.filter').slideDown("slow");
    });
    $('#closeFilterXS').click(function(){
        $('.filter').slideUp("slow");
    });
    enquire.register('screen and (max-width: 991px)', {
        match : function() {
            $('.banners').addClass('jcarousel');
        },
        unmatch : function() {
            $('.banners').removeClass('jcarousel');
        }
    });
    enquire.register('screen and (max-width: 767px)', {
        match : function() {
            $('.banners').addClass('jcarousel');
            var jcarousel = $('.jcarousel');
            jcarousel
                .on('jcarousel:reload jcarousel:create', function () {
                    var carousel = $(this),
                        width = carousel.innerWidth() + 20;
                    carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
                })
                .jcarousel();
            $('.jcarousel-pagination')
                .on('jcarouselpagination:active', 'a', function() {
                    $(this).addClass('active');
                })
                .on('jcarouselpagination:inactive', 'a', function() {
                    $(this).removeClass('active');
                })
                .jcarouselPagination();
        }
    });
    enquire.register('screen and (min-width: 768px) and (max-width: 991px)', {
        match : function() {
            $('.banners').addClass('jcarousel');
            var jcarousel = $('.jcarousel');
            jcarousel
                .on('jcarousel:reload jcarousel:create', function () {
                    var carousel = $(this),
                        width = carousel.innerWidth() / 2;
                    carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
                })
                .jcarousel({
                    wrap: 'circular'
                });
            $('.jcarousel-control-prev')
                .jcarouselControl({
                    target: '-=1'
                });
            $('.jcarousel-control-next')
                .jcarouselControl({
                    target: '+=1'
                });
        }
    });
    $('.main-select').selectator({
        useSearch: false
    });
});