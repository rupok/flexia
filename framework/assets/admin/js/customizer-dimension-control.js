(function($) {
    'use strict';
    $(document).ready(function() {
        $(".customize-control-flexia-dimension").each(function() {
            let dimension_control = $(this).find('.flexia-dimension-control');
            let dinput1 = $(this).find('.flexia-dimension-input-1');
            let dinput2 = $(this).find('.flexia-dimension-input-2');
            let dinput3 = $(this).find('.flexia-dimension-input-3');
            let dinput4 = $(this).find('.flexia-dimension-input-4');
            let data_unit = $(this).find('.flexia-dimension-input-1').attr('data-unit');
            let dimension_result = {
                input1: dinput1.val(),
                input2: dinput2.val(),
                input3: dinput3.val(),
                input4: dinput4.val(),
                data_unit: data_unit
            };
            dimension_control.val(JSON.stringify(dimension_result)).change();
        });

        // Disconnected button
        $('.flexia-dimension-disconnected').on('click', function() {

            // Set up variables
            var elements = $(this).data('element-connect');

            // Add connected class
            $(this).parent().parent('.flexia-dimension-fields').find('input').addClass('connected').removeClass('disconnected').attr('data-element-connect', elements);

            // Add class
            $(this).parent('.flexia-dimension-link').addClass('connected');

        });

        // Connected button
        $('.flexia-dimension-connected').on('click', function() {

            // Remove connected class
            $(this).parent().parent('.flexia-dimension-fields').find('input').removeClass('connected').addClass('disconnected').attr('data-element-connect', '');

            // Remove class
            $(this).parent('.flexia-dimension-link').removeClass('connected');

        });

        // select responsive css units
        $(document).on('click', '.flexia-spacing-responsive-units .single-unit', function() {
            $(this).parents("li").find('.flexia-spacing-responsive-units .single-unit').removeClass('active');
            $(this).addClass('active');
            let dimension_control = $(this).parents('.customize-control-flexia-dimension').find('.flexia-dimension-control');
            let unit = $(this).attr('data-unit');
            let dimension_control_units = JSON.parse(dimension_control.val());
            $(this).parents("li").find('.flexia-dimension-fields .dimension-field .flexia-dimension-input').attr('data-unit', unit);
            dimension_control_units.data_unit = unit;
            dimension_control.val(JSON.stringify(dimension_control_units)).change();
        });

        // Values connected inputs
        $(document).on('input', ".flexia-dimension-input.connected", function() {

            var dataElement = $(this).attr('data-element-connect'),
                currentFieldValue = $(this).val();
            let dimension_control = $(this).parents('.customize-control-flexia-dimension').find('.flexia-dimension-control');
            let dimension_result = JSON.parse(dimension_control.val());

            $(this).parent().parent('.flexia-dimension-fields').find('.connected[ data-element-connect="' + dataElement + '" ]').each(function(key, value) {
                $(this).val(currentFieldValue).change();
                let eachDataInput = $(this).attr('data-input');
                let dataUnit = $(this).attr('data-unit');
                dimension_result[eachDataInput] = $(this).val();
                dimension_result['data_unit'] = dataUnit;
                dimension_control.val(JSON.stringify(dimension_result)).change();
            });

        });

        $(document).on('input', ".flexia-dimension-input.disconnected", function() {
            let dimension_control = $(this).parents('.customize-control-flexia-dimension').find('.flexia-dimension-control');
            let dimension_result = JSON.parse(dimension_control.val());
            let dataInput = $(this).attr('data-input');
            let dataUnit = $(this).attr('data-unit');
            dimension_result[dataInput] = $(this).val();
            dimension_result['data_unit'] = dataUnit;
            dimension_control.val(JSON.stringify(dimension_result)).change();
        });
    });
})(jQuery);