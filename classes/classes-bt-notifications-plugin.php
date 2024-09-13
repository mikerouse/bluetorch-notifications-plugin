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
        public function add_admin_menu() {
            add_menu_page(
                'Bluetorch Notifications',
                'BT Notifications',
                'manage_options',
                'bluetorch-notifications',
                array($this, 'display_admin_page'),
                'dashicons-bell',
                30
            );
        }
        public function display_admin_page() {
            ?>
            <div class="wrap">
                <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
                <form method="post" action="options.php">
                    <?php
                    settings_fields('bluetorch_notifications_options');
                    do_settings_sections('bluetorch-notifications');
                    submit_button('Save Settings');
                    ?>
                </form>
            </div>
            <?php
        }
        public function register_settings() {
            register_setting('bluetorch_notifications_options', 'bluetorch_notifications_settings');
            add_settings_section(
                'bluetorch_notifications_general',
                'General Settings',
                array($this, 'settings_section_callback'),
                'bluetorch-notifications'
            );
            add_settings_field(
                'notification_frequency',
                'Notification Frequency',
                array($this, 'notification_frequency_callback'),
                'bluetorch-notifications',
                'bluetorch_notifications_general'
            );
        }
        public function settings_section_callback() {
            echo '<p>Configure your notification settings here.</p>';
        }
        public function notification_frequency_callback() {
            $options = get_option('bluetorch_notifications_settings');
            $frequency = isset($options['notification_frequency']) ? $options['notification_frequency'] : 'daily';
            ?>
            <select name="bluetorch_notifications_settings[notification_frequency]">
                <option value="hourly" <?php selected($frequency, 'hourly'); ?>>Hourly</option>
                <option value="daily" <?php selected($frequency, 'daily'); ?>>Daily</option>
                <option value="weekly" <?php selected($frequency, 'weekly'); ?>>Weekly</option>
            </select>
            <?php
        }
    }
}
?> 