angular.module('freeyachting').directive('formIndex', function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var index = $('.add-traveller').length;
            var inputs = $(element).find('input, select');

            for (var i = 0; i < inputs.length; i++) {
                inputs[i].id = inputs[i].id.replace(/__name__/g, index);
                inputs[i].name = inputs[i].name.replace(/__name__/g, index);
            }
        }
    }
});
