<?php 
/**
 * Plugin Name: Bluetorch Notifications Plugin
 * Description: A simple plugin to send notifications about new posts to the user via their browser notifications.
 * Version: 1.0.0
 * Plugin URI: https://www.bluetorch.co.uk/
 * Author: Mike Rouse (for Bluetorch Consulting Ltd)
 * Author URI: https://www.bluetorch.co.uk/
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
**/

// Include the main plugin class file
require_once plugin_dir_path(__FILE__) . 'classes/classes-bt-notifications-plugin.php';
// Instantiate the plugin class
$bt_notifications_plugin = new BT_Notifications_Plugin();
// Register activation hook
register_activation_hook(__FILE__, array($bt_notifications_plugin, 'activate'));
// Register deactivation hook
register_deactivation_hook(__FILE__, array($bt_notifications_plugin, 'deactivate'));
// Register uninstall hook
register_uninstall_hook(__FILE__, array('BT_Notifications_Plugin', 'uninstall'));

?>