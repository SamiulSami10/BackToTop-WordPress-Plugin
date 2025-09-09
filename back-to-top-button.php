<?php
/**
 * Plugin Name: Back To Top Button
 * Description: A simple plugin to add a back-to-top button with smooth scroll and customizable settings.
 * Version: 1.1
 * Author: Pranto
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue assets with dynamic styles
 */
function bttb_enqueue_assets()
{
    $options = get_option('bttb_settings');

    wp_enqueue_style('bttb-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('bttb-script', plugin_dir_url(__FILE__) . 'assets/script.js', array('jquery'), null, true);

    // Inline CSS for custom settings
    $color = !empty($options['color']) ? $options['color'] : '#333';
    $position = !empty($options['position']) && $options['position'] === 'left' ? 'left:30px;' : 'right:30px;';

    $custom_css = "
        #back-to-top {
            background: {$color};
            {$position}
        }
    ";
    wp_add_inline_style('bttb-style', $custom_css);

    // Pass scroll speed to JS
    $speed = !empty($options['speed']) ? intval($options['speed']) : 600;
    wp_localize_script('bttb-script', 'bttb_settings', array('speed' => $speed));
}
add_action('wp_enqueue_scripts', 'bttb_enqueue_assets');

/**
 * Add Back to Top Button Markup
 */
function bttb_add_button()
{
    echo '<button id="back-to-top">&#8679;</button>';
}
add_action('wp_footer', 'bttb_add_button');

/**
 * Admin Settings Page
 */
function bttb_register_settings()
{
    register_setting('bttb_settings_group', 'bttb_settings');
}
add_action('admin_init', 'bttb_register_settings');

function bttb_settings_page()
{
    ?>
    <div class="wrap">
        <h1>Back To Top Button Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('bttb_settings_group'); ?>
            <?php $options = get_option('bttb_settings'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">Button Color</th>
                    <td>
                        <input type="color" name="bttb_settings[color]"
                            value="<?php echo esc_attr($options['color'] ?? '#333333'); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Position</th>
                    <td>
                        <select name="bttb_settings[position]">
                            <option value="right" <?php selected($options['position'] ?? '', 'right'); ?>>Right</option>
                            <option value="left" <?php selected($options['position'] ?? '', 'left'); ?>>Left</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Scroll Speed (ms)</th>
                    <td>
                        <input type="number" name="bttb_settings[speed]"
                            value="<?php echo esc_attr($options['speed'] ?? '600'); ?>" min="100" step="100">
                        <p class="description">How fast the page scrolls to top (in milliseconds).</p>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function bttb_add_admin_menu()
{
    add_options_page(
        'Back To Top Settings',
        'Back To Top',
        'manage_options',
        'bttb-settings',
        'bttb_settings_page'
    );
}
add_action('admin_menu', 'bttb_add_admin_menu');
