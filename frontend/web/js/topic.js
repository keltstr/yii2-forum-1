jQuery(function ($) {
    (function () {
        var form = $('#topic-form');
        if (form.length == 0) {
            return;
        }

        var category = form.find('#topic-category_id'),
            section = form.find('#topic-section_id');

        category.on('change', function () {
            if (category.val().length > 0) {
                category.prop('disabled', true);
                section.prop('disabled', true);

                $.get(yii.sectionsUrl(category.val()), function (data) {
                    category.prop('disabled', false);
                    section.prop('disabled', false).html(data);
                });
            } else {
                section.prop('disabled', true).html('');
            }
        });
    })();
});
