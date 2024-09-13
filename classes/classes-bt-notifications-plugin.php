<?php 
/**
 * Classes to handle the WordPress plugin's functionality
 *
 * @package Bluetorch Notifications Plugin
 * @author Mike Rouse (Bluetorch Consulting Ltd)
 * @license MIT
 * @link https://bluetorch.co.uk/
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('BT_Notifications_Plugin')) {
    class BT_Notifications_Plugin {
        private $plugin_name;
        private $version;
        public function __construct() {
            $this->plugin_name = 'bluetorch-notifications-plugin';
            $this->version = '1.0.0';
            $this->load_dependencies();
            $this->define_hooks();
        }
        public function activate() {
            // Any activation logic here
        }
        public function deactivate() {
            // Any deactivation logic here
        }
        public static function uninstall() {
            // Any uninstall logic here
        }
        private function load_dependencies() {
            // Load any required files
        }
        private function define_hooks() {
            add_action('admin_menu', array($this, 'add_admin_menu'));
            add_action('admin_init', array($this, 'register_settings'));
        }
        // ... (rest of the methods you've already implemented)
    }
}
?> 