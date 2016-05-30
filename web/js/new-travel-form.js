function addDay() {
    var selector = '.days-list';
    var index = $(selector).children().length;
    var list = $(selector);
    var prototype = $('.day-prototype').data('prototype');
    var newForm = prototype.replace(/__name__/g, index);
    newForm = newForm.replace(/__day__/g, index + 1);
    $(list).append(newForm);
    var inputs = $(list).find('.row input');
    var input = inputs[inputs.length - 1];

    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "ru",
        autoclose: true,
        disableTouchKeyboard: true,
        todayHighlight: true
    });
}
