<?php

// No direct access, please
if (!defined('ABSPATH')) exit;


/**
 * The template for displaying the Call To Action 1
 *
 * Contains cta-1
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexia
 */

$cta_layout = flexia_get_option('flexia_call_to_action_layout');
$cta_title = flexia_get_option('flexia_call_to_action_title');
$cta_subtitle = flexia_get_option('flexia_call_to_action_subtitle');
$cta_button_text = flexia_get_option('flexia_call_to_action_button_text');
$cta_button_url = flexia_get_option('flexia_call_to_action_url');

?>

<div class="container cta-<?php echo esc_attr($cta_layout); ?>-container">
	<div class="content">
        
        <?php if(!empty($cta_title)) : ?>
        <h1 class="cta-title">
            <?php echo $cta_title; ?>
        </h1>
        <?php endif; ?>

        <?php if(!empty($cta_subtitle)) : ?>
        <h2 class="cta-subtitle">
            <?php echo $cta_subtitle; ?>
        </h2>
        <?php endif; ?>

        <a class="cta-target" href="<?php echo $cta_button_url; ?>">
            <button>
                <?php echo $cta_button_text; ?>
            </button>
        </a>
    </div>
</div>