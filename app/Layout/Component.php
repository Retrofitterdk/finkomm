<?php
/**
 * Layout Component.
 *
 * Manages the layout component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Layout;

use WP_Customize_Manager;

use Hybrid\App;
use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

/**
 * Layout component class.
 *
 * @since  1.2.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the layouts object.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    Layouts
	 */
	protected $layouts;

	/**
	 * Creates the component object.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  Layouts  $layouts
	 * @return void
	 */
	public function __construct( Layouts $layouts ) {
		$this->layouts = $layouts;
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on `after_setup_theme`.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Add customizer settings and controls.
		add_action( 'customize_register', [ $this, 'customizeRegister'] );

		// Adds a layout body class on the front end.
		add_filter( 'body_class', [ $this, 'bodyClass' ] );

		// Register default layouts.
		add_action( 'exhale/layout/register', [ $this, 'registerDefaultLayouts' ] );
	}

	/**
	 * Runs the register actions.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom layouts.
		do_action( 'exhale/layout/register', $this->layouts );
	}

	/**
	 * Registers default layouts.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  Layouts  $layouts
	 * @return void
	 */
	public function registerDefaultLayouts( $layouts ) {

		foreach ( Config::get( 'layouts' ) as $name => $options ) {
			$layouts->add( $name, $options );
		}
	}

	/**
	 * Customize register callback.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function customizeRegister( WP_Customize_Manager $manager ) {

		$mods = App::resolve( 'exhale/mods' );

		$manager->add_section( 'layout', [
			'panel'    => 'theme_options',
			'title'    => __( 'Layout', 'exhale' ),
			'priority' => 5
		] );

		$manager->add_setting( 'layout', [
			'default'           => $mods['layout'],
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'postMessage'
		] );

		$manager->add_control( 'layout', [
			'section'     => 'layout',
			'type'        => 'select',
			'label'       => __( 'Global Layout', 'exhale' ),
			'description' => __( 'Select the layout used across the site.', 'exhale' ),
			'choices'     => $this->layouts->customizeChoices()
		] );
	}

	/**
	 * Filter on the body class on the front end that adds our layout class.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  array  $classes
	 * @return array
	 */
	public function bodyClass( $classes ) {

		$mods = App::resolve( 'exhale/mods' );

		$classes[] = sanitize_html_class(
			sprintf(
				'layout-%s',
				get_theme_mod( 'layout', $mods['layout'] )
			)
		);

		return $classes;
	}
}
