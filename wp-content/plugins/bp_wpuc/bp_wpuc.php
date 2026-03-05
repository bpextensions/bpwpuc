<?php
/**
 * Plugin Name: BP Under Construction
 * Plugin URI: ${author.url}
 * Description: Displaying Under Construction page for non admin users.
 * Version: ${build.version}
 * Author: ${author.name}
 * Author URI: ${author.url}
 * Text Domain: bpwpuc
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP:      7.3
 */

/**
 * @package     ${package}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights},  All rights reserved.
 * @license     ${license.name}; see ${license.url}
 * @author      ${author.name}
 */

use BPExtensions\WPUC\Admin\Settings;
use BPExtensions\WPUC\Plugin;

require_once __DIR__ . '/vendor/autoload.php';

define('PATH_BPWPUC', __DIR__);

add_action('init', [Plugin::class, 'loadTranslationDomain'], 0);

// Only on front-end
if (!is_admin() && !Plugin::isAdmin()) {

    // On system initialization
    add_action('init', [Plugin::class, 'frontend'], 0);

// Administration
} else {
    if (is_admin()) {
        add_action('admin_menu', [Settings::class, 'registerMenuItem']);
        add_action('admin_init', [Settings::class, 'registerSettingsFields']);
        add_filter('plugin_action_links_bp_wpuc/bp_wpuc.php', [Settings::class, 'addSettingsLink']);
    }
}
