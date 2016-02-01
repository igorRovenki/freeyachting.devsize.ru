function pluralForm( n, forms ) {
    return forms[(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2) ];
}
//****************************************************************************
// Предотвращает выполнение действия перехода по ссылке: href="#"
//****************************************************************************
jQuery(document).ready(function () {
    $('[href="#"]').click(function (e) {
        e.preventDefault();
    });
    $('.panel>.panel-heading a').click(function () {
        var idAccordionTab = $(this).attr('href');
        var classThis = $(this).parent().parent().attr('class');
        if (classThis == 'hidden-xs') {
            $('#accordion>.panel>.panel-heading').css('background-color', '#ffffff');
            $('#accordion>.panel>.panel-heading>.hidden-xs>h4').css('color', '#61b1c5');
            $('#accordion>.panel>.panel-heading>.hidden-xs>h4>a').css('background', 'url("/img/icons.png") -110px -110px');
        }
        else {
            $('#accordion>.panel>.panel-heading').css('background-color', '#ffffff');
            $('#accordion>.panel>.panel-heading>.visible-xs>h4>a').css('color', '#61b1c5');
        }
        if ($(idAccordionTab).hasClass('in')) {
            if (classThis == 'hidden-xs') {
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
            if (classThis == 'hidden-xs') {
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
    $('.answer-show').click(function () {
        $(this).parent().fadeOut("slow");
        $(this).parent().parent().next().slideDown("slow");
        $(this).parent().next().fadeIn("slow");
    });
    $('.answer-hidden').click(function () {
        $(this).parent().parent().slideUp("slow");
        $(this).parent().parent().prev().children('.question-button').fadeIn("slow");
        $(this).parent().parent().prev().children('.question-triagle').fadeOut("slow");

    });
    $('.seawolf-block .btn-7').click(function () {
        $('.how-it-works').slideDown('slow');
        $(this).addClass('disabled');
    });
    $('.how-close').click(function () {
        $('.how-it-works').slideUp('slow');
        $('.seawolf-block .btn-7').removeClass('disabled');
    });
    $('.input-group input').focus(function () {
        $(this).next('.input-group-addon').css('border-color', '#61b1c5');
    }).blur(function () {
        $(this).next('.input-group-addon').css('border-color', '#ccc');
    });
    $('.left-addon > input').focus(function () {
        $(this).prev().css('border-color', '#61b1c5');
    }).blur(function () {
        $(this).prev().css('border-color', '#ccc');
    });
    $('.main-select>.input-group-btn>ul').scrollator({
        zIndex: '10000'
    });
    $('.main-select>.input-group-btn>ul>li >a').click(function () {
        if ($(this).attr('data-value')) {
            $(this).parent().parent().parent().prev('input').prev('input').val($(this).attr('data-value'));
        }
        $(this).parent().parent().parent().prev('input').val($(this).html());

        if (this.id == "yesChild") {
            if ($('#ageChild').hasClass('disabled')) {
                $('#ageChild').removeClass('disabled');
                $('#ageChild').children('input').removeAttr('disabled');
            }
        }
        if (this.id == "noChild") {
            if (!$('#ageChild').hasClass('disabled')) {
                $('#ageChild').addClass('disabled');
                $('#ageChild').children('input').attr('disabled', true);
            }
        }
    });

    $('#inputParticipationChildren').change(function () {
        if ($(this).val() == "yes") {
            $('#ageChild').attr('disabled', false);
        }
        if ($(this).val() == "no") {
            $('#ageChild').attr('disabled', true);
        }
    });
    $('#inputDiscountHot').change(function () {
        if ($(this).val() == "yes") {
            $('#inputDiscountHotPercent').attr('disabled', false);
            $('#inputDiscountHotDate').attr('disabled', false);
        }
        if ($(this).val() == "no") {
            $('#inputDiscountHotPercent').attr('disabled', true);
            $('#inputDiscountHotDate').attr('disabled', true);
        }
    });
    $('#filterXS').click(function () {
        $('.filter').slideDown("slow");
    });
    $('#closeFilterXS').click(function () {
        $('.filter').slideUp("slow");
    });

    //var prev = $('.buttons-gender label.btn.active');
    $('.buttons-gender label.btn').click(function() {
        var holder = $(this).parent().parent().parent();
        /* Change avatar when changing "gender" */
        var avatar = $(holder).find('.file-default-preview img');
        if (avatar.attr('src').match(/avatar/)) {
            if (gender == 'm') {
                avatar.attr('src', '/images/avatar.png');
            }
            if (gender == 'w') {
                avatar.attr('src', '/images/avatar2.png');
            }
        }
    });
    /* Custom radio buttons */
    $('.radio-item').click(function() {
        var id = $(this).attr('data-radio-hidden-id');
        var value = $(this).attr('data-radio-value');
        $('#' + id).val(value);

        if ($(this).hasClass('active')) {
            return;
        }
        $(this).parent().find('.radio-item').toggleClass('active');
    });
    enquire.register('screen and (max-width: 991px)', {
        match: function () {
            $('.banners').addClass('jcarousel');
        },
        unmatch: function () {
            $('.banners').removeClass('jcarousel');
        }
    });
    enquire.register('screen and (max-width: 767px)', {
        match: function () {
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
                .on('jcarouselpagination:active', 'a', function () {
                    $(this).addClass('active');
                })
                .on('jcarouselpagination:inactive', 'a', function () {
                    $(this).removeClass('active');
                })
                .jcarouselPagination();
        }
    });
    enquire.register('screen and (min-width: 768px) and (max-width: 991px)', {
        match: function () {
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
    // Datepicker
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "ru",
        autoclose: true,
        disableTouchKeyboard: true,
        todayHighlight: true
    });
    $('.fa-calendar, .datepicker-select button').click(function() {
        $('.datepicker').datepicker('show');
    });

    var places = [];

    $('.choice-place .place').click(function() {
        var icon = $(this).children()[0];
        if ($(this).hasClass('busy')) {
            console.log('busy...');
            return;
        }
        $(icon).toggleClass('glyphicon-check');
        $(icon).toggleClass('glyphicon-unchecked');
        var place = $(this).attr('data-place');

        if ($(icon).hasClass('glyphicon-check')) {
            $('#places_form').append('<input type="hidden" name="places[]" id="place' + place + '" value="' + place + '">')
        }
        if ($(icon).hasClass('glyphicon-unchecked')) {
            $('#place' + place).remove();
        }
        var placesNumber = $('#places_form').children().length;
        $('#places_choosed').text(placesNumber);
        $('#total_sum').text(placesNumber * price);
        $('#plural-places').text(pluralForm(placesNumber, ['место', 'места', 'мест']))
    });
    var placesNumber = $('#places_form').children().length;
    $('#plural-places').text(pluralForm(placesNumber, ['место', 'места', 'мест']));

    try {
        $('.main-select').selectator({
            useSearch: false
        });
    } catch (e) {
        console.log(e)
    }
});