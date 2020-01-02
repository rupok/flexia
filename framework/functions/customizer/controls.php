<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

class Customizer_Range_Value_Control extends WP_Customize_Control {
	public $type = 'range-value';

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 3.4.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'customizer-range-value-control', get_template_directory_uri() . '/framework/assets/admin/js/customizer-range-value-control.js', array( 'jquery' ), rand(), true );

		wp_enqueue_style( 'customizer-range-value-control', get_template_directory_uri() . '/framework/assets/admin/css/customizer-range-value-control.css', array(), rand() );
	}

	/**
	 * Render the control's content.
	 *
	 * @author soderlind
	 * @version 1.2.0
	 */
	public function render_content() {
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title reset-control-title"><?php echo esc_html( $this->label ); ?></span>
				<a href="#" title="<?php echo esc_html__('Reset', 'flexia') ?>" class="flexia-customizer-reset <?php echo esc_html( $this->type ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="20px"><path d="M 25 2 C 12.321124 2 2 12.321124 2 25 C 2 37.678876 12.321124 48 25 48 C 37.678876 48 48 37.678876 48 25 A 2.0002 2.0002 0 1 0 44 25 C 44 35.517124 35.517124 44 25 44 C 14.482876 44 6 35.517124 6 25 C 6 14.482876 14.482876 6 25 6 C 30.475799 6 35.391893 8.3080175 38.855469 12 L 35 12 A 2.0002 2.0002 0 1 0 35 16 L 46 16 L 46 5 A 2.0002 2.0002 0 0 0 43.970703 2.9726562 A 2.0002 2.0002 0 0 0 42 5 L 42 9.5253906 C 37.79052 4.9067015 31.727675 2 25 2 z"></path></svg></a>
			<?php endif; ?>
			<div class="range-slider" data-default-val="<?php echo $this->settings[ 'default' ]->value(); ?>" style="width:100%; display:flex;flex-direction: row;justify-content: flex-start;">
				<span  style="width:100%; flex: 1 0 0; vertical-align: middle;"><input class="range-slider__range" type="range" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs(); $this->link(); ?>>
				<span class="range-slider__value">0</span></span>
			</div>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
		<?php
	}
}


class Customizer_Toggle_Control extends WP_Customize_Control {
	public $type = 'ios';

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 3.4.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'customizer-toggle-control', get_template_directory_uri() . '/framework/assets/admin/js/customizer-toggle-control.js', array( 'jquery' ), rand(), true );
		wp_enqueue_style( 'pure-css-toggle-buttons', get_template_directory_uri() . '/framework/assets/admin/css/customizer-togle-buttons.css', array(), rand() );

		$css = '
			.disabled-control-title {
				color: #a0a5aa;
			}
			input[type=checkbox].tgl-light:checked + .tgl-btn {
				background: #0085ba;
			}
			input[type=checkbox].tgl-light + .tgl-btn {
			  background: #a0a5aa;
			}
			input[type=checkbox].tgl-light + .tgl-btn:after {
			  background: #f7f7f7;
			}

			input[type=checkbox].tgl-ios:checked + .tgl-btn {
			  background: #0085ba;
			}

			input[type=checkbox].tgl-flat:checked + .tgl-btn {
			  border: 4px solid #0085ba;
			}
			input[type=checkbox].tgl-flat:checked + .tgl-btn:after {
			  background: #0085ba;
			}

		';
		wp_add_inline_style( 'pure-css-toggle-buttons' , $css );
	}

	/**
	 * Render the control's content.
	 *
	 * @author soderlind
	 * @version 1.2.0
	 */
	public function render_content() {
		?>
		<label>
			<div style="display:flex;flex-direction: row;justify-content: flex-start;">
				<span class="customize-control-title" style="flex: 2 0 0; vertical-align: middle;"><?php echo esc_html( $this->label ); ?></span>
				<input id="cb<?php echo $this->instance_number ?>" type="checkbox" class="tgl tgl-<?php echo $this->type?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
				<label for="cb<?php echo $this->instance_number ?>" class="tgl-btn"></label>
			</div>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
		<?php
	}
}


/* Custom Title */

class Separator_Custom_control extends WP_Customize_Control{
	public $type = 'separator';
	public function render_content(){
		?>
		<label>
			<h4 class="customize-control-title flexia-customize-subtitle"><?php echo esc_html( $this->label ); ?></h4>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
		<?php
	}
}


/**
 * Select2 Multi-Select
 */
class Customizer_Select2_Multiselect extends WP_Customize_Control {

	public $type = 'select2_multiselect';

	public function enqueue() {
		wp_enqueue_script( 'select2-min-js', get_template_directory_uri() . '/framework/assets/admin/js/select2.min.js', array( 'jquery' ), rand(), true );
		wp_enqueue_style( 'select2-css', get_template_directory_uri() . '/framework/assets/admin/css/select2.min.css', array(), rand() );
		wp_enqueue_style( 'customizer-select2-control', get_template_directory_uri() . '/framework/assets/admin/css/customizer-select2-control.css', array(), rand() );
	}

	public function render_content() {
		if( empty( $this->choices ) )
			return;
		?>
		<label>
			<?php if( !empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<select <?php $this->link(); ?> class="js-select2-multiselect" multiple="multiple">
				<?php
					foreach( $this->choices as $value => $label ) {
						echo '<option value="' . esc_attr( $value ) . '">' . $label . '</option>';
					}
				?>
			</select>
		</label>
		<script>
			jQuery(document).ready(function() {
			    jQuery('.js-select2-multiselect').select2();
			});
		</script>
		<?php

	}

}


/**
 * Select2 Multi-Select
 */
class Customizer_Select2_Google_Fonts extends WP_Customize_Control {

	public $type = 'select2_google_fonts';

	public function enqueue() {
		wp_enqueue_script( 'select2-min-js', get_template_directory_uri() . '/framework/assets/admin/js/select2.min.js', array( 'jquery' ), rand(), true );
		wp_enqueue_style( 'select2-css', get_template_directory_uri() . '/framework/assets/admin/css/select2.min.css', array(), rand() );
		wp_enqueue_style( 'customizer-select2-control', get_template_directory_uri() . '/framework/assets/admin/css/customizer-select2-control.css', array(), rand() );
	}

	public function render_content() {
		if( empty( $this->choices ) )
			return;
		?>
		<label>
			<?php if( !empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<select <?php $this->link(); ?> class="js-select2-font-select">
				<?php
					foreach( $this->choices as $value => $label ) {
						echo '<option value="'.$label['name'].'" ' . selected( $this->value(), $label['name'], false ) . '>'.$label['family'].'</option>';
					}
				?>
			</select>
		</label>
		<script>
			jQuery(document).ready(function() {
			    jQuery('.js-select2-font-select').select2();
			});
		</script>
		<?php

	}

}


?>
