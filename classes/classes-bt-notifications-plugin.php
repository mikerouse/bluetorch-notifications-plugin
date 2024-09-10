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
            // Activation logic
        }

        public function deactivate() {
            // Deactivation logic
        }

        public static function uninstall() {
            // Uninstallation logic
        }
      
        private function load_dependencies() {
            // Load required files
        }

        private function define_hooks() {
            // Define WordPress action and filter hooks
        }
    }
}
?> 