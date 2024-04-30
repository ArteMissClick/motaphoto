<?php

function motaphoto_register_assets() {
	wp_enqueue_style( 'style-mota', get_stylesheet_uri() );
  wp_enqueue_script('jquery');
	wp_enqueue_script( 'script-mota', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true );
}


register_nav_menus( array(
	'main' => 'Menu Principal',
	'footer' => 'Bas de page',
) );


// **** Actions ****
add_action( 'wp_enqueue_scripts', 'motaphoto_register_assets' );

?>