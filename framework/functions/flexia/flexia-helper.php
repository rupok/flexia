<?php
/**
 *
 * @package Flexia
 */


//CSS replace "Dash" with "Space"
if( ! function_exists( 'flexia_replae_dash_with_space' ) ) : 

	function flexia_replae_dash_with_space($value){
        $value = ucwords(str_replace("-"," ",$value));
        
		return $value;
	}

endif;


//Flexia Color Hex Value to RGBA Value
if( ! function_exists( 'flexia_hex2rgba' ) ) : 

    function flexia_hex2rgba($color, $opacity) {
 
        $default = 'rgb(255,255,255,0)';
    
        //Return default if no color provided
        if(empty($color))
            return $default; 
    
        //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if(empty($opacity)){
            $opacity = 0;
            if(abs($opacity) > 1) {
                $opacity = 1.0;
            }
        }
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';

        //Return rgb(a) color string
        return $output;
    }
endif;