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

use WPSermonManager\Modules\SermonsApp;
use WPSermonManager\Modules\Menu;
use WPSermonManager\Modules\PostTypes\Sermon as SermonPostType;
use WPSermonManager\Modules\Taxonomies\Books as BooksTaxonomy;
use WPSermonManager\Modules\Taxonomies\Series as SeriesTaxonomy;
use WPSermonManager\Modules\Taxonomies\Speakers as SpeakersTaxonomy;
use WPSermonManager\Modules\Taxonomies\Topics as TopicsTaxonomy;

if ( ! defined( 'WPINC' ) )  die;

// Useful global constants.
define( 'WP_SERMON_MANAGER_VERSION', '1.0.0' );
define( 'WP_SERMON_MANAGER_URL',     plugin_dir_url( __FILE__ ) );
define( 'WP_SERMON_MANAGER_PATH',    dirname( __FILE__ ) . '/' );
define( 'WP_SERMON_MANAGER_INC',     WP_SERMON_MANAGER_PATH . 'includes/' );

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Initializes the plugin.
 */
function initialize() {

	$plugin = new Plugin();

	add_action( 'init', [ $plugin, 'setup' ] );

	$menu             = new Menu();
	$sermon           = new SermonPostType( $menu );
	$sermonsApp       = new SermonsApp();
	$sermonsApp->setPlugin( $plugin );
	$plugin
		->registerModule( $menu )
		->registerModule( $sermon )
		->registerModule( new BooksTaxonomy( $menu ) )
		->registerModule( new SeriesTaxonomy( $menu ) )
		->registerModule( new SpeakersTaxonomy( $menu ) )
		->registerModule( new TopicsTaxonomy( $menu ) )
		->registerModule( $sermonsApp );

	/**
	 * Allow other plugins to hook in and extend the plugin class
	 *
	 * @param Plugin $plugin
	 */
	do_action( 'wp_sermon_manager_loaded', $plugin );
}
add_action( 'after_setup_theme', 'WPSermonManager\initialize', 20 );

/**
 * Function to run at plugin activation.
 */
function activate() {
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'WPSermonManager\activate' );
