<?php
/**
 * Singleton trait.
 *
 * @package Baobab
 */

namespace Baobab\Inc\Traits;

trait Singleton {
	/**
	 * Prevent direct object creation.
	 */
	protected function __construct() {}

	/**
	 * Prevent object cloning.
	 */
	final protected function __clone() {}

	/**
	 * Prevent object unserializing.
	 */
	final public function __wakeup() {
		throw new \Exception( 'Cannot unserialize singleton' );
	}

	/**
	 * Returns class instance.
	 *
	 * @return static
	 */
	final public static function get_instance() {
		static $instance = [];
		$called_class = get_called_class();

		if ( ! isset( $instance[ $called_class ] ) ) {
			$instance[ $called_class ] = new $called_class();
		}

		return $instance[ $called_class ];
	}
}