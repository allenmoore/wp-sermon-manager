<?php

namespace WPSermonManager\Modules\ActivitiesApp;

interface TypeInterface {

	/**
	 * Get a slug for this type
	 *
	 * @return string
	 */
	public function getTypeSlug();

	/**
	 * Return the name of a template in templates/app/tmpl (without .php)
	 *
	 * The template should be wrapped in template script tags.
	 *
	 * @return string
	 */
	public function getTemplateName();

}
