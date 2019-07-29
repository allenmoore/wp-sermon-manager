<?php
/**
 * Plugin Name: WP Sermon Manager
 * Plugin URI:  https://github.com/allenmoore/wp-sermon-manager
 * Description: WP Sermon Manager makes it easy for churches to easily publish sermons online.
 * Version:     1.0.0
 * Author:      Allen Moore
 * Author URI:  https://allenmoore.co
 * Text Domain: wp-sermon-manager
 * Domain Path: /languages
 * License:     MIT
 */

/**
 * Copyright (c) 2019 Allen Moore (email : am@allenmoore.co)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace WPSermonManager;

use WPSermonManager\Plugin;

// Useful global constants.
define( 'WP_SERMON_MANAGER_VERSION', '1.0.2' );
define( 'WP_SERMON_MANAGER_URL',     plugin_dir_url( __FILE__ ) );
define( 'WP_SERMON_MANAGER_PATH',    dirname( __FILE__ ) . '/' );
define( 'WP_SERMON_MANAGER_INC',     WP_SERMON_MANAGER_PATH . 'includes/' );

require_once( WP_SERMON_MANAGER_INC . 'Plugin.php' );
require_once( WP_SERMON_MANAGER_INC . 'Helpers.php' );
require_once( WP_SERMON_MANAGER_INC . 'SermonsCPT.php' );
require_once( WP_SERMON_MANAGER_INC . 'UserRoles.php' );
require_once( WP_SERMON_MANAGER_INC . 'Settings.php' );
require_once( WP_SERMON_MANAGER_INC . 'SpeakersTaxonomy.php' );
require_once( WP_SERMON_MANAGER_INC . 'SeriesTaxonomy.php' );
require_once( WP_SERMON_MANAGER_INC . 'TopicsTaxonomy.php' );
require_once( WP_SERMON_MANAGER_INC . 'BooksTaxonomy.php' );
require_once( WP_SERMON_MANAGER_INC . 'ServiceTypeTaxonomy.php' );
require_once( WP_SERMON_MANAGER_INC . 'TemplateTags.php' );

/**
 * Initializes the plugin.
 *
 * @return void
 */
function initialize() {
	$plugin = new Plugin();

	/**
	 * Allow other plugins to hook in and extend the plugin class
	 *
	 * @param Plugin $plugin
	 */
	do_action( 'wpsm_loaded', $plugin );
}
add_action( 'after_setup_theme', 'WPSermonManager\initialize', 20 );
