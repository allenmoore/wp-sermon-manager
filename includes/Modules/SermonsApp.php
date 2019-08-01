<?php
/**
 * Sermon App
 *
 * @package WPSermonManager\Modules
 */
namespace WPSermonManager\Modules;

use WPSermonManager\Modules\ActivitiesApp\TypeInterface;
use WPSermonManager\Modules\Taxonomies\Meta\SpeakerImage as SpeakerImageMeta;
use WPSermonManager\PluginInterface;
use WPSermonManager\Util\HasPluginTrait;

/**
 * The SermonsApp Class.
 *
 * Handles implementing the Sermon App module.
 *
 * @since 1.0.0
 */
class SermonsApp implements ModuleInterface {

	/** @var string */
	const KEY = 'wpsm-sermons-app-mn';

	use HasPluginTrait;

	/** @var TypeInterface[] */
	private $types = [ ];

	public $speakerImageMeta;

	/**
	 * Method to get this module's slug
	 *
	 * Slugs should be unique
	 *
	 * @return string
	 */
	public function getModuleSlug() {
		return static::KEY;
	}

	/**
	 * Method to initialize the module. Whatever a module needs to do prior to init should be done here.
	 *
	 * This would include hooking into the glp_lcm_init action (runs on init, but is specific to this plugin.
	 *
	 * @param PluginInterface $plugin
	 */
	public function setupModule( PluginInterface $plugin ) {
		add_action( 'wp_sermon_manager_init', [ $this, 'registerDefaultTypes' ] );
		add_action( 'wp_loaded', [ $this, 'registerAssets' ] );

		$this->speakerImageMeta = new SpeakerImageMeta();
	}

	/**
	 * Method to register default sermon types
	 *
	 * Also does an action to let other code hook in and register types
	 */
	public function registerDefaultTypes() {
		do_action( 'wp_sermon_manager_app_init', $this );
	}

	/**
	 * Method to register scripts and styles
	 */
	public function registerAssets() {

		$min = defined( 'SCRIPT_DEBUG' ) && filter_var( SCRIPT_DEBUG, FILTER_VALIDATE_BOOLEAN ) ? '' : '.min';
		$pluginUrl = trailingslashit( WP_SERMON_MANAGER_URL );

		wp_register_style(
			'wpsm-admin-css',
			esc_url( $pluginUrl . 'dist/css/admin' . $min . '.css' ),
			false,
			'1.0.0'
		);

		wp_enqueue_style( 'wpsm-admin-css' );
	}

	/**
	 * Method to render the app for a post
	 *
	 * @param \WP_Post $post
	 */
	public function render( $post ) {

		wp_enqueue_script( $this->getModuleSlug() );

		$this->getPlugin()->template( 'app/activities-main', compact( 'post' ) );

		foreach ( $this->types as $type ) {
			if ( $template = $type->getTemplateName() ) {
				$this->getPlugin()->template( "app/tmpl/$template", compact( 'post' ) );
			}
		}
	}

	/**
	 * Method to register a type interface
	 *
	 * @param TypeInterface $type
	 */
	public function registerType( TypeInterface $type ) {
		$this->types[ $type->getTypeSlug() ] = $type;
	}

	/**
	 * Method to get a registered type object
	 *
	 * @param string|TypeInterface $type
	 *
	 * @return TypeInterface|null
	 */
	public function getType( $type ) {
		if ( $type instanceof TypeInterface ) {
			$type = $type->getTypeSlug();
		}

		return isset( $this->types[ $type ] ) ? $this->types[ $type ] : null;
	}

}
