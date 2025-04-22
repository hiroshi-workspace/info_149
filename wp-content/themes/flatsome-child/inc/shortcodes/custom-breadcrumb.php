
<?php
// Breadcrumbs
function custom_breadcrumb() 
    {
        // Bắt đầu breadcrumb
        echo '<nav class="custom-breadcrumb" aria-label="breadcrumb">';
        echo '<a href="' . home_url() . '">Trang chủ</a>  ';
    
        
    
        // Kiểm tra nếu đang ở trong trang danh mục sản phẩm
        if (is_product_category()) {
            // Hiển thị liên kết đến trang sản phẩm
            echo '» <a href="' . get_permalink(wc_get_page_id('shop')) . '">  Sản phẩm</a> » ';
    
            // Lấy danh mục hiện tại và các danh mục cha
            $category = get_queried_object();
            $ancestors = get_ancestors($category->term_id, 'product_cat');
            $ancestors = array_reverse($ancestors); // Đảo ngược để hiển thị đúng thứ tự cha -> con
    
            // Hiển thị các danh mục cha
            foreach ($ancestors as $ancestor) {
                $ancestor_category = get_term($ancestor, 'product_cat');
                echo '<a href="' . get_term_link($ancestor_category->term_id, 'product_cat') . '">' . $ancestor_category->name . '</a> » ';
            }
    
            // Hiển thị danh mục hiện tại
            echo $category->name;
        }
        // Kiểm tra nếu đang ở trong trang sản phẩm
        elseif (is_product()) {
            // Hiển thị liên kết đến trang sản phẩm
            echo ' » '.'<a href="' . get_permalink(wc_get_page_id('shop')) . '"></a>  ';
    
            // Hiển thị liên kết đến danh mục sản phẩm nếu có
            $terms = get_the_terms(get_the_ID(), 'product_cat');
            if ($terms && ! is_wp_error($terms)) {
                // Lấy danh mục chính hoặc đầu tiên
                $term = array_shift($terms);
    
                // Hiển thị các danh mục cha (nếu có)
                $ancestors = get_ancestors($term->term_id, 'product_cat');
                $ancestors = array_reverse($ancestors);
                foreach ($ancestors as $ancestor) {
                    $ancestor_category = get_term($ancestor, 'product_cat');
                    echo '<a href="' . get_term_link($ancestor_category->term_id, 'product_cat') . '">' . $ancestor_category->name . '</a> » ';
                }
    
                // Hiển thị danh mục hiện tại
                echo '<a href="' . get_term_link($term) . '">' . $term->name . '</a> » ';
            }
    
            // Hiển thị tên sản phẩm hiện tại
            echo get_the_title();
        }
        // Nếu không phải là trang sản phẩm hoặc danh mục sản phẩm
        else {
            // Hiển thị tiêu đề trang
            // echo single_post_title();
            echo single_post_title(' » ', false);
        }
    
        echo '</nav>';
    }
// Đăng ký shortcode
add_shortcode('custom_breadcrumb', 'custom_breadcrumb');

