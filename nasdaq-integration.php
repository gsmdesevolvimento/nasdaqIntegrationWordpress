<?php

/*
Plugin Name: Integração com API da Nasdaq
Description: Plugin desenvolvido para realizar integração com API da Nasdaq
Plugin URI: https://github.com/gsmdados/nasdaq-integration-wordpress
Version: 1.0.0
Author: Guilherme Sousa
Author URI: https://github.com/gsmdados
*/

if (!defined('ABSPATH')) {
	exit('Access denied');
}

require_once(plugin_dir_path(__FILE__) . 'models/nasdaq.class.php');
require_once(plugin_dir_path(__FILE__) . 'controllers/application.class.php');

$application = new Application(plugin_dir_path(__FILE__));

add_action('admin_menu', array($application, 'adminInterface'));

add_action('wp_footer', array($application, 'viewMainContent'));