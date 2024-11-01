<?php

function wifplugin_enqueue_style() {
	wp_enqueue_style('wif-main-style', WIFPLUGIN_URL . 'css/style.css');
}


function wifplugin_enqueue_script() {
	wp_enqueue_script('wif-main-script', WIFPLUGIN_URL . 'js/main.js');

}

add_action('wp_enqueue_scripts', 'wifplugin_enqueue_style');
add_action('wp_enqueue_scripts', 'wifplugin_enqueue_script');
