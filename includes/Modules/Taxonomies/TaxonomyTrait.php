<?php
namespace WPSermonManager\Modules\Taxonomies;

use WPSermonManager\MetaInterface;

trait TaxonomyTrait {

	abstract public function getTaxonomySlug();

	protected $registeredMeta = [ ];

	/**
	 * Get the labels for this taxonomy
	 *
	 * @return object
	 */
	public function getLabels() {
		return get_taxonomy( $this->getTaxonomySlug() )->labels;
	}

	/**
	 * Get the capabilities for this taxonomy
	 *
	 * @return object
	 */
	public function getCaps() {
		return get_taxonomy( $this->getTaxonomySlug() )->cap;
	}

	/**
	 * Register meta for this taxonomy
	 *
	 * @param MetaInterface $meta
	 *
	 * @return $this
	 */
	public function registerTaxonomyMeta( MetaInterface $meta ) {
		$this->registeredMeta[ $meta->getMetaKey() ] = $meta;

		return $this;
	}

}
