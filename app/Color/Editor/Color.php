<?php
/**
 * Color Editor Color.
 *
 * Creates an editor color object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Color\Editor;

use Exhale\Contracts\CssCustomProperty;
use Exhale\Tools\Mod;
use function Hybrid\hex_to_rgb;


/**
 * Editor color class.
 *
 * @since  1.0.0
 * @access public
 */
class Color implements CssCustomProperty {

	/**
	 * Color name.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $name;

	/**
	 * Color label.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $label;

	/**
	 * Color (hex).
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $color = '000000';

	/**
	 * Whether the color should be taken from theme mods.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    bool
	 */
	protected $is_theme_mod = false;

	/**
	 * Set up the object properties.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $options
	 * @return void
	 */
	public function __construct( $name, array $options = [] ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
			if ( isset( $options[ $key ] ) ) {
				$this->$key = $options[ $key ];
			}
		}

		$this->name = $name;
	}

	/**
	 * Returns the color name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Returns the color label.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		return apply_filters(
			"exhale/color/editor/{$this->name}/label",
			$this->label ?: $this->name(),
			$this
		);
	}

	/**
	 * Returns the color value.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function color() {
		return $this->isThemeMod() ? Mod::color( $this->name() ) : $this->color;
	}

	/**
	 * Returns the hex color code.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function hex() {
		return maybe_hash_hex_color( $this->color() );
	}

	/**
	 * Returns an array (`r`, `g`, `b`, keys) of the setting value in RGB.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function rgb() {
		return hex_to_rgb( $this->color() );
	}

	/**
	 * Whether the color is a theme mod.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 */
	public function isThemeMod() {
		return $this->is_theme_mod;
	}

	/**
	 * Returns a valid CSS selector for the property.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return string
	 */
	public function cssSelector() {
		return ':root';
	}

	/**
	 * Returns the CSS property.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return string
	 */
	public function cssProperty() {
		return sprintf( '--color-%s', $this->name() );
	}

	/**
	 * Returns the CSS property value.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return string
	 */
	public function cssValue() {
		return $this->hex() ?: 'transparent';
	}

	/**
	 * Returns the CSS custom property selector for the color.
	 *
	 * @since      1.0.0
	 * @deprecated 1.1.0
	 * @access     public
	 * @return     string
	 */
	public function property() {
		return $this->cssProperty();
	}
}
