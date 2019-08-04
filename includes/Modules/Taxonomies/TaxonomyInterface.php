<?php
/**
 * Taxonomy Interface
 *
 * @package WPSM\Modules\Taxonomies
 */
namespace WPSM\Modules\Taxonomies;

use WPSM\MetaInterface;

/**
 * Interface TaxonomyInterface
 *
 * Handles method declaration when registering taxonomy objects.
 *
 * @since 1.0.0
 */
interface TaxonomyInterface {

	/**
	 * Method to get the taxonomy slug
	 *
	 * @return string
	 */
	public function getTaxonomySlug();

	/**
	 * Method to register the taxonomy
	 */
	public function registerTaxonomy();

	/**
	 * Method to get the labels for this taxonomy
	 *
	 * @return object
	 */
	public function getLabels();

	/**
	 * Method to get the capabilities for this taxonomy
	 *
	 * @return object
	 */
	public function getCaps();

	/**
	 * Method to register meta for this taxonomy
	 *
	 * @param MetaInterface $meta
	 *
	 * @return $this
	 */
	public function registerTaxonomyMeta( MetaInterface $meta );

}
