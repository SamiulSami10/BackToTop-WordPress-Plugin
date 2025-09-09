<?php
/**
 * Plugin Name: Back To Top Button
 * Description: A simple plugin to add a back-to-top button with smooth scroll.
 * Version: 1.0
 * Author: Pranto
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue CSS and JS
function bttb_enqueue_assets()
{
    wp_enqueue_style('bttb-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('bttb-script', plugin_dir_url(__FILE__) . 'assets/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'bttb_enqueue_assets');

// Add button markup to footer
function bttb_add_button()
{
    echo '<button id="back-to-top">&#8679;</button>';
}
add_action('wp_footer', 'bttb_add_button');
