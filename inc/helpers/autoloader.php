<?php
/**
 * Autoloader file for theme.
 *
 * @package Baobab
 */

namespace Baobab\Inc\Helpers;

/**
 * Auto loader function.
 *
 * @param string $resource Source namespace.
 *
 * @return void
 */
function autoloader( $resource = '' ) {
	$resource_path  = '';
	$namespace_root = 'Baobab\\';
	$resource       = trim( $resource, '\\' );

	if ( empty( $resource ) || false === strpos( $resource, '\\' ) || 0 !== strpos( $resource, $namespace_root ) ) {
		// Not our namespace, bail out.
		return;
	}

	// Remove our root namespace.
	$resource = str_replace( $namespace_root, '', $resource );

	$path = explode(
		'\\',
		str_replace( '_', '-', strtolower( $resource ) )
	);

	/**
	 * Determine resource path by type.
	 */
	if ( empty( $path[0] ) || empty( $path[1] ) ) {
		return;
	}

	$directory = '';
	$file_name = '';

	if ( 'inc' === $path[0] ) {
		switch ( $path[1] ) {
			case 'traits':
				$directory = 'traits';
				$file_name = sprintf( 'trait-%s', trim( strtolower( $path[2] ?? '' ) ) );
				break;

			case 'widgets':
			case 'blocks':
				/**
				 * If class name is provided for specific directory then load that.
				 * Otherwise find in inc/classes directory.
				 */
				if ( ! empty( $path[2] ) ) {
					$directory = sprintf( 'classes/%s', $path[1] );
					$file_name = sprintf( 'class-%s', trim( strtolower( $path[2] ) ) );
					break;
				}
				// no break

			default:
				$directory = 'classes';
				$file_name = sprintf( 'class-%s', trim( strtolower( $path[1] ) ) );
				break;
		}

		$resource_path = sprintf( '%s/inc/%s/%s.php', untrailingslashit( BAOBAB_DIR_PATH ), $directory, $file_name );
	}

	if ( empty( $resource_path ) ) {
		return;
	}

	$is_valid_file = validate_file( $resource_path );

	if ( file_exists( $resource_path ) && ( 0 === $is_valid_file || 2 === $is_valid_file ) ) {
		require_once $resource_path;
	}
}

spl_autoload_register( '\Baobab\Inc\Helpers\autoloader' );
