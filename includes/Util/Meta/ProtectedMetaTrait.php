<?php
namespace WPSermonManager\Util\Meta;

trait ProtectedMetaTrait {

	protected $__metaType = 'post';

	/**
	 * @return string
	 */
	abstract public function getMetaKey();

	protected function addProtectedMetaFilter() {
		add_filter( 'is_protected_meta', [ $this, 'isProtected' ], 10, 3 );
	}

	/**
	 * Make this meta protected
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
	 * @param string $_metaType
	 */
	public function setMetaType( $_metaType ) {
		$this->__metaType = $_metaType;
	}

}
