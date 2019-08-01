<?php
/**
 * Meta Trait
 *
 * @package WPSermonManager\Util\Meta
 */
namespace WPSermonManager\Util\Meta;

/**
 * Trait ProtectedMetaTrait
 *
 * Handles method inheritance and reuse for meta objects.
 *
 * @since 1.0.0
 */
trait ProtectedMetaTrait {

	/** @var string */
	protected $__metaType = 'post';

	/**
	 * Method to get the meta key
	 *
	 * This method must be defined with the same (or less restricted) visibility in any child class.
	 *
	 * @return string
	 */
	abstract public function getMetaKey();

	/**
	 * Method to add a protected meta filter to a meta object
	 */
	protected function addProtectedMetaFilter() {
		add_filter( 'is_protected_meta', [ $this, 'isProtected' ], 10, 3 );
	}

	/**
	 * Method to make this meta protected
	 *
	 * @param bool $isProtected
	 * @param string $key
	 * @param string $type
	 *
	 * @return bool
	 */
	public function isProtected( $isProtected, $key, $type ) {
		return ( $type === $this->__metaType && $key === $this->getMetaKey() ) ?: $isProtected;
	}

	/**
	 * Method to set the meta type.
	 *
	 * @param string $_metaType
	 */
	public function setMetaType( $_metaType ) {
		$this->__metaType = $_metaType;
	}
}
