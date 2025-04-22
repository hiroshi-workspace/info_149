<?php

include get_stylesheet_directory() . '/inc/functions/functions_cong.php';

// Load Js
function mytheme_enqueue_style_js() {
    // Đăng ký jQuery (nếu cần)
    wp_enqueue_script('jquery');

    // Tải script của bạn
    wp_enqueue_script('js-cong', get_stylesheet_directory_uri() . '/assets/js/js-cong.js', array('jquery'), '1.1', true);
    wp_enqueue_script('css-mb', get_stylesheet_directory_uri() . '/assets/css/style-mb.css', '1.1', true);
}

// Thêm action để enqueue scripts
add_action('wp_enqueue_scripts', 'mytheme_enqueue_style_js');