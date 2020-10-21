(function($) {
    "use strict";

    /**
     * This function will toggle metabox based on container value
     */
    function flexia_toggle_metabox(baseContainer, targetContainer) {
        // Default State
        var valueToMatch = $(baseContainer).val();
        var target = $(targetContainer);
        if (valueToMatch == "yes") {
            target
                .removeClass("flexia-hide-metabox")
                .addClass("flexia-show-metabox");
        } else {
            target
                .removeClass("flexia-show-metabox")
                .addClass("flexia-hide-metabox");
        }
        // If Toggle
        $(baseContainer).on("change", function() {
            var valueToMatch = $(baseContainer).val();
            var target = $(targetContainer);
            if (valueToMatch == "yes") {
                target
                    .removeClass("flexia-hide-metabox")
                    .addClass("flexia-show-metabox");
            } else {
                target
                    .removeClass("flexia-show-metabox")
                    .addClass("flexia-hide-metabox");
            }
        });
    }
    flexia_toggle_metabox(
        "#_flexia_post_meta_key_header_meta",
        ".js-flexia-alter"
    );
})(jQuery);


//Flexia Post Hide Header Meta Controls on "Show Header Meta" display No
jQuery('#flexia_header_meta').on('change', function() {
    var meta_classes = ["#flexia_post_author", "#flexia_post_date", "#flexia_post_category", "#flexia_post_comment_count"];
    var val = this.value;
    if (val == 'no') {
        jQuery(meta_classes).each(function(key, item) {
            jQuery(item).closest('.flexia_metabox_item').hide(250);
        });
    }
    else {
        jQuery(meta_classes).each(function(key, item) {
            jQuery(item).closest('.flexia_metabox_item').show(250);
        });
    }
});

