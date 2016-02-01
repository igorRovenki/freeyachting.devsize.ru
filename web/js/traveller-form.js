function addTraveller(place) {
    var index = $('.add-traveller').length;
    var holder = $('.form-items');
    var prototype = $(holder).data('prototype');
    var newForm = prototype.replace(/__name__/g, index);
    holder.append('<div class="row add-traveller">' + newForm + '</div>');
    holder.append('<div class="deliver"></div>');
    $('#app_booking_travellers_' + index + '_placeNumber').val(place);

    $(".file-loading").fileinput({
        language: 'ru',
        overwriteInitial: true,
        maxFileSize: 2000,
        showClose: false,
        showCaption: false,
        browseLabel: 'Загрузить фото',
        browseClass: 'btn btn-file btn-2',
        buttonLabelClass: '',
        removeLabel: '',
        browseIcon: '',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors' + index,
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src="/images/avatar.png" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} {browse}', preview: '<div class="file-preview-thumbnails"></div>'},
        previewSettings: {image: {width: "180px", height: "180px"}},
        allowedFileExtensions: ["jpg", "jpeg", "png", "gif"]
    });

    $('.radio-item').click(function () {
        var id = $(this).attr('data-radio-hidden-id');
        var value = $(this).attr('data-radio-value');
        $('#' + id).val(value);

        if ($(this).hasClass('active')) {
            return;
        }
        $(this).parent().find('.radio-item').toggleClass('active');
    });
    $('.buttons-gender label.btn').click(function() {
        var gender = $(this).attr('data-radio-value');
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

    $('.has-children').change(function () {
        var parent = $(this).parent().parent().parent();
        if ($(this).val() == 1) {
            $(parent).find('.child-number-option').attr('disabled', true);
            $(parent).find('.child-age-option').attr('disabled', true);
        }
        if ($(this).val() == 0) {
            $(parent).find('.child-number-option').attr('disabled', false);
            $(parent).find('.child-age-option').attr('disabled', false);
        }
    });
}
