<?php

/**
 * Posts layout.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

// do_action('flatsome_before_blog');
?>
<?php
$category_name = single_cat_title('', false); // Lấy tên category hiện tại
if (!$category_name) {
    $category_name = 'Sodonews'; // Tên mặc định nếu không lấy được tên category
}
echo do_shortcode('[banner_news category="' . esc_attr($category_name) . '"]');
?>

<?php if (!is_single() && get_theme_mod('blog_featured', '') == 'top') {
    get_template_part('template-parts/posts/featured-posts');
} ?>
<div class="row align-center">
    <div class="text-breadcrumb-blog">
        <?php
        $category_name = single_cat_title('', false);
        if (!$category_name) {
            $category_name = 'Sodonews'; // Tên mặc định nếu không lấy được tên category
        } // Lấy tên category hiện tại
        echo do_shortcode('[custom_breadcrumb_with_name page_name="' . esc_attr($category_name) . '"]');
        ?>
    </div>
    <div class="large-12 col">
        <?php if (!is_single() && get_theme_mod('blog_featured', '') == 'content') {
            get_template_part('template-parts/posts/featured-posts');
        } ?>

        <?php
        if (is_single()) {
            get_template_part('template-parts/posts/single_new');
            comments_template();
        } elseif (get_theme_mod('blog_style_archive', '') && (is_archive() || is_search())) {
            get_template_part('template-parts/posts/archive', get_theme_mod('blog_style_archive', ''));
        } else {
            get_template_part('template-parts/posts/archive', get_theme_mod('blog_style', 'normal'));
        }
        ?>
    </div>

</div>

<?php do_action('flatsome_after_blog');
