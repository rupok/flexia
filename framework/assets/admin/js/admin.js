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
