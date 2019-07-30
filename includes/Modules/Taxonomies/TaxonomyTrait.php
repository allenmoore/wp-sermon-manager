<?php
/**
 * Taxonomy Trait
 *
 * @package WPSermonManager\Modules\Taxonomies
 */
namespace WPSermonManager\Modules\Taxonomies;

use WPSermonManager\MetaInterface;

/**
 * Trait TaxonomyTrait
 *
 * Handles method inheritance and reuse for taxonomy objects.
 *
 * @since 1.0.0
 */
trait TaxonomyTrait {

	/**
	 * Method to get the taxonomy slug
	 *
	 * This method must be defined with the same (or less restricted) visibility in any child class.
	 *
	 * @return mixed
	 */
	abstract public function getTaxonomySlug();

	/** @var array */
	protected $registeredMeta = [ ];

	/**
	 * Method to get the labels for this taxonomy
	 *
	 * @return object
	 */
	public function getLabels() {
		return get_taxonomy( $this->getTaxonomySlug() )->labels;
	}

	/**
	 * Method to get the capabilities for this taxonomy
	 *
	 * @return object
	 */
	public function getCaps() {
		return get_taxonomy( $this->getTaxonomySlug() )->cap;
	}

	/**
	 * Method to register meta for this taxonomy
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
