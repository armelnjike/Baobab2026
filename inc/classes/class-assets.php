<?php
/*
* Enqueue theme assets
*
* @package baobab
*/
namespace Baobab\Inc;

use Baobab\Inc\Traits\Singleton;

class Assets{
    use Singleton;


    protected function __construct() {
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		// Actions and filters.

		add_action('wp_enqueue_scripts', [$this, 'register_styles'],99);
		add_action('wp_enqueue_scripts',[$this, 'register_scripts']);
	}


    public function register_styles(){
		//register Bootstrap
        wp_register_style(
            'bootstrap-css',//unique name/ID for the stylesheet and should be prefixed with your theme slug
            BAOBAB_DIR_URI . "/assets/src/library/css/css/bootstrap.min.css" , //URL of your stylesheet
            [], // other stylesheet handles that your stylesheet is dependent upon
            false, //sets the version number of your stylesheet and is used for cache busting
            'all'   // which type of media to load this stylesheet for (all (default)
        );
		wp_register_style(
        'Baobabstyles',//unique name/ID for the stylesheet and should be prefixed with your theme slug
        get_stylesheet_uri() , //URL of your stylesheet
        [], // other stylesheet handles that your stylesheet is dependent upon
        filemtime(BAOBAB_DIR_PATH . '/style.css'), //sets the version number of your stylesheet and is used for cache busting
        'all'   // which type of media to load this stylesheet for (all (default), screen, print, or handheld)
    	);

		// enqueue
		/*
    *enqueueing a stylesheet, which tells WordPress that you want
    * to put it in the queue to load. You would use this function
    * within an action hook callback in your functions.php file
    */
		wp_enqueue_style(
            'Baobabstyles'
        );
		wp_enqueue_style(
            'bootstrap-css'
        );
	}
	public function register_scripts(){

		wp_register_script(
        'baobab-js',  // unique name/ID for the script and should be prefixed with your theme slug
        BAOBAB_DIR_URI . '/assets/main.js',  // URL of your script
        [], // other script handles that your script is dependent upon
        filemtime(BAOBAB_DIR_PATH.'/assets/main.js'), // Sets the version number of your script
        true  //Determines whether to load the script in the header or footer (true = footer).
    	);

        wp_register_script(
        'bootstrap-js',  // unique name/ID for the script and should be prefixed with your theme slug
        BAOBAB_DIR_URI . "/assets/src/library/css/js/bootstrap.bundle.min.js",  // URL of your script
        ["jquery"], // other script handles that your script is dependent upon
        filemtime(BAOBAB_DIR_PATH."/assets/src/library/css/js/bootstrap.bundle.min.js"), // Sets the version number of your script
        true  //Determines whether to load the script in the header or footer (true = footer).
        );

		wp_enqueue_script(
            'baobab-js'
        );
        wp_enqueue_script(
            'bootstrap-js'
        );
	}
}
