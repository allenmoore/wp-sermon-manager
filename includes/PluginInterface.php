<?php
/**
 * Plugin Interface
 *
 * @package WPSermonManager
 */
namespace WPSermonManager;

use WPSermonManager\Modules\ModuleInterface;
use WPSermonManager\Modules\PostTypes\PostTypeInterface;
use WPSermonManager\Modules\Taxonomies\TaxonomyInterface;

/**
 * Interface PluginInterface
 *
 * Handles method declaration for plugins.
 *
 * @since 1.0.0
 */
interface PluginInterface {

	/**
	 * Register a module with the plugin
	 *
	 * @param ModuleInterface $module
	 *
	 * @return $this
	 */
	public function registerModule( ModuleInterface $module );

	/**
	 * Register a post type object
	 *
	 * @param PostTypeInterface $postType
	 *
	 * @return $this
	 */
	public function registerPostType( PostTypeInterface $postType );

	/**
	 * Get a post type object
	 *
	 * @param string $name
	 *
	 * @return PostTypeInterface|null
	 */
	public function getPostType( $name );

	/**
	 * Register a taxonomy object
	 *
	 * @param TaxonomyInterface $taxonomy
	 *
	 * @return $this
	 */
	public function registerTaxonomy( TaxonomyInterface $taxonomy );

	/**
	 * Get a taxonomy object
	 *
	 * @param string $name
	 *
	 * @return TaxonomyInterface|null
	 */
	public function getTaxonomy($name);

	/**
	 * Get a menu object. By default it will return the first available menu
	 *
	 * @param string $slug
	 *
	 * @return MenuInterface|null
	 */
	public function getMenu( $slug = '' );

	/**
	 * Add another menu
	 *
	 * @param MenuInterface $menu
	 *
	 * @return $this
	 */
	public function registerMenu( MenuInterface $menu );

	/**
	 * Render a template
	 *
	 * @param string $__template_file
	 * @param array $__template_data
	 * @param boolean $__admin_tmpl
	 */
	public function template( $__template_file, array $__template_data = [ ], bool $__admin_tmpl = false );

}
