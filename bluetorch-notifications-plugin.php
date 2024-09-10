<?php 
/**
 * Plugin Name: Bluetorch Notifications Plugin
 * Description: A plugin to send notifications about new posts to the user via their browser notifications
 * Version: 1.0.0
 * Plugin URI: https://bluetorch.co.uk/
 * Author: Mike Rouse (Bluetorch Consulting Ltd)
 * Author URI: https://bluetorch.co.uk/
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
**/

// Register the plugin
register_activation_hook( __FILE__, array( $plugin, 'activate' ) );
register_deactivation_hook( __FILE__, array( $plugin, 'deactivate' ) );
register_uninstall_hook( __FILE__, array( $plugin, 'uninstall' ) );

// Classes for the plugin's functionality

require_once( 'classes/class-bt-notifications-plugin.php' );

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

private function define_hooks() {
    add_action('admin_menu', array($this, 'add_admin_menu'));
    add_action('admin_init', array($this, 'register_settings'));
}

?>