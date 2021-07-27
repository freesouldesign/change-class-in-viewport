<?php
/*
Plugin Name: Change class in viewport
Description: It helps you to add your custom animations on scroll just with a few lines of CSS.
Author: Jose Mortellaro
Author URI: https://josemortellaro.com
Domain Path: /languages/
Version: 0.0.2
*/
/*  This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_filter( 'body_class','eos_cciv_body_class' );
//Add body class
function eos_cciv_body_class( $classes ){
  $classes[] = 'cciv-no-script';
  return $classes;
}
add_action( 'wp_footer','eos_cciv_js' );
function eos_cciv_js(){
  ?><script> function eos_cciv_inViewport(e){var b = e.getBoundingClientRect();return !(b.top > innerHeight || b.bottom < 0);} function eos_cciv_init(){ document.body.className = document.body.className.replace(' cciv-no-script','').replace('cciv-no-script',''); document.addEventListener( 'scroll',function(){ var els = document.querySelectorAll("<?php echo esc_js( esc_attr( apply_filters( 'cciv_el_selector','.cciv-el') ) ); ?>"),n = 0; for(n;n<els.length;++n){ if(eos_cciv_inViewport(els[n])){ els[n].className = els[n].className.replace(' not-in-viewport','').replace(' in-viewport','') + ' in-viewport'; } else { els[n].className = els[n].className.replace(' not-in-viewport','').replace(' in-viewport','') + ' not-in-viewport'; } } }); } eos_cciv_init(); </script><?php
}
