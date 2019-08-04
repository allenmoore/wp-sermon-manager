<?php
/**
 * Rest Field
 *
 * @package WPSM\Util\Meta
 */
namespace WPSM\Util\Meta;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The AbstractRestField Class
 *
 * Handles method inheritance and reuse for rest fields.
 *
 * @since 1.0.0
 */
abstract class AbstractRestField {

	use RestFieldTrait;

}
