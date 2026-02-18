<?php
/**
 * Theme functions
 *
 * @package Baobab
 */

if ( ! defined( 'BAOBAB_DIR_PATH' ) ) {
	define( 'BAOBAB_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'BAOBAB_DIR_URI' ) ) {
	define( 'BAOBAB_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}


require_once BAOBAB_DIR_PATH . '/inc/helpers/autoloader.php';

function baobab_get_theme_instance(){
    \Baobab\Inc\Baobab_Theme::get_instance();
}

baobab_get_theme_instance();

/*
* functions.php essentially acts like a WordPress plugin, letting you add custom PHP
* functions, classes, interfaces, and more. It opens up the entirety of the PHP 
* programming language to your theme.
*/

function baobab_enqueue_scripts() {
    /*
    *enqueueing a stylesheet, which tells WordPress that you want
    * to put it in the queue to load. You would use this function
    * within an action hook callback in your functions.php file
    */
    

    wp_add_inline_style( 
		'Baobab-primary', 
		'body { background: blue; }'
	);

    


}

// Include scripts


add_action('wp_enqueue_scripts', 'baobab_enqueue_scripts',99);
