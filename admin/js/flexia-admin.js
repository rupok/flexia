//Hide Header Meta Controls on "Show Header Meta" display No
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