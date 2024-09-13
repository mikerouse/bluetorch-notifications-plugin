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

// Register the plugin
register_activation_hook(__FILE__, array('BT_Notifications_Plugin', 'activate'));
register_deactivation_hook(__FILE__, array('BT_Notifications_Plugin', 'deactivate'));
register_uninstall_hook(__FILE__, array('BT_Notifications_Plugin', 'uninstall'));


// Create the plugin class
class BT_Notifications_Plugin {
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
            null,
            'bluetorch-notifications'
        );
    }

    // Add other methods like activate, deactivate, and uninstall here
    public static function activate() {
        $plugin = new self();
        // Add the admin menu
        add_action('admin_menu', array($plugin, 'add_admin_menu'));

        // Register the settings
        add_action('admin_init', array($plugin, 'register_settings'));
    }

    public static function deactivate() {
        // Remove the admin menu
        remove_menu_page('bluetorch-notifications');

        // Unregister the settings
        unregister_setting('bluetorch_notifications_options', 'bluetorch_notifications_settings');
    }

    public static function uninstall() {
        // Delete the settings
        delete_option('bluetorch_notifications_settings');
    }

}

// Instantiate the plugin class
$plugin = new BT_Notifications_Plugin();

?>