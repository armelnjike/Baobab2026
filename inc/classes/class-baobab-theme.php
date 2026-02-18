<?php
/**
 * Main theme class.
 *
 * @package Baobab
 */

namespace Baobab\Inc;

use Baobab\Inc\Traits\Singleton;

class Baobab_Theme {
	use Singleton;

	protected function __construct() {
		//wp_die("dieeeeeeeeee  !");
		Assets::get_instance();
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		// Actions and filters.

		add_action('after_setup_theme', [$this, 'setup_theme']);
	
	}
	public function setup_theme(){
		add_theme_support( 'title-tag' );

		add_theme_support('custom-logo',[
			'header-text'=>['site-title','site-description'],
			'height'=>100,
			'width'=>100,
			'flex-height'=>true,
			'flex-width'=>true,
		]);
	}

	// End of the class
}
