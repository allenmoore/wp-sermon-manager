<?php

namespace WPSermonManager\Modules\Taxonomies;

use WPSermonManager\MetaInterface;

interface TaxonomyInterface {

	/**
	 * Get the taxonomy slug
	 *
	 * @return string
	 */
	public function getTaxonomySlug();

	/**
	 * Register the taxonomy
	 */
	public function registerTaxonomy();

	/**
	 * Get the labels for this taxonomy
	 *
	 * @return object
	 */
	public function getLabels();

	/**
	 * Get the capabilities for this taxonomy
	 *
	 * @return object
	 */
	public function getCaps();

	/**
	 * Register meta for this taxonomy
	 *
	 * @param MetaInterface $meta
	 *
	 * @return $this
	 */
	public function registerTaxonomyMeta( MetaInterface $meta );

}
