<?php

// Include Shortcodes
function include_my_shortcodes()
{

    // include get_stylesheet_directory() . '/inc/shortcodes/custom-breadcrumb.php';
    include get_stylesheet_directory() . '/inc/shortcodes/display-custom-product.php';
    // include get_stylesheet_directory() . '/inc/shortcodes/post-date.php';



}
add_action('init', 'include_my_shortcodes');


// Thêm chữ liên hệ khi ko nhập giá
add_filter('woocommerce_get_price_html','custom_price_display',10,2);

function custom_price_display($price, $product) {
    // Kiểm tra xem sản phẩm có giá trị hay ko
    if(!$product->get_price())
    {
        return '<a class="contact-price" href="tel:0961423094"><span class="contact-price">Liên Hệ </span></a>';
    }
    return $price;
}


// Thêm short description vào loop sản phẩm
function add_short_description_to_product_loop() {
    // Kiểm tra có phải trang shop hoặc trang danh mục không
    if (is_shop() || is_product_category()) {
        global $product;

        // Lấy short description
        $short_description = $product->get_short_description();

        // Nếu có short description thì hiển thị
        if (!empty($short_description)) {
            echo '<div class="product-short-desc">' . wp_trim_words($short_description, 20, '...') . '</div>';
        }
    }
}
// Hook vào sau title sản phẩm
// add_action('woocommerce_shop_loop_item_title', 'add_short_description_to_product_loop', 20);

function wc_remove_checkout_fields( $fields ) {

    // Billing fields
    unset( $fields['billing']['billing_state'] );
    unset( $fields['billing']['billing_address_1'] );
    unset( $fields['billing']['billing_address_2'] );
    unset( $fields['billing']['billing_city'] );
    unset( $fields['billing']['billing_postcode'] );

    // Shipping fields
    unset( $fields['shipping']['shipping_state'] );
    unset( $fields['shipping']['shipping_address_1'] );
    unset( $fields['shipping']['shipping_address_2'] );
    unset( $fields['shipping']['shipping_city'] );
    unset( $fields['shipping']['shipping_postcode'] );

    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'wc_remove_checkout_fields' );