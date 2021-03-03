(function($) {
    'use strict';

    $(document).ready(function() {
        wp.customize.bind('ready', function() {
            var dimensionReset = jQuery('.flexia-dimension .flexia-customizer-reset');
            dimensionReset.each(function() {
                $(dimensionReset).on('click', function(e) {
                    e.preventDefault();
                    var dimensionId = $(this).parent('.flexia-dimension').attr('id');
                    $('.' + dimensionId).each(function() {
                        var dimensionDefaultVal = $(this).data('default-val');
                        $(this).val(dimensionDefaultVal).trigger('change');
                    });
                });
            });
            var selectReset = jQuery('.flexia-select .flexia-customizer-reset');
            selectReset.each(function() {
                $(selectReset).on('click', function(e) {
                    e.preventDefault();
                    var dimensionId = $(this).parent('.flexia-select').attr('id');
                    $('.' + dimensionId).each(function() {
                        var dimensionDefaultVal = $(this).data('default-val');
                        $(this).val(dimensionDefaultVal).change().trigger('change');
                    });
                });
            });
        });
    });
})(jQuery);