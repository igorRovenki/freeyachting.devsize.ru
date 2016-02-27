angular.module('freeyachting').directive('fileupload', function() {
    return {
        restrict: 'A',
        scope: {
            traveller: '='
        },
        link: function(scope, element, attrs) {
            scope.$watch('traveller.gender', function(gender) {
                var holder = $(element).parent().parent().parent();
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

            $(element).fileinput({
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
                elErrorContainer: '#kv-avatar-errors',
                msgErrorClass: 'alert alert-block alert-danger',
                defaultPreviewContent: '<img src="/images/avatar.png" alt="Your Avatar">',
                layoutTemplates: {main2: '{preview} {browse}', preview: '<div class="file-preview-thumbnails"></div>'},
                previewSettings: {image: {width: "180px", height: "180px"}},
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"]
            });
        }
    }
});
