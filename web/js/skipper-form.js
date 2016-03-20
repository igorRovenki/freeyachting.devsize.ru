function addWaterExperience(type) {
    var index = $('.exp-list').children().length;
    var list = $('.exp-list.' + type);
    var prototype = $('.water-prototype').data('prototype');
    var newForm = prototype.replace(/__name__/g, index);
    $(list).append(newForm);
    var inputs = $(list).find('.row input');
    var input = inputs[inputs.length - 1];
    $(input).val(type);
}
