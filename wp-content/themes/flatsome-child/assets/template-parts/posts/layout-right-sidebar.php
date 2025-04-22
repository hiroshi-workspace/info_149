<?php

/**
 * Posts layout right sidebar.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

do_action('flatsome_before_blog');
?>
<div class="banner has-hover hide-for-small" id="banner-1613537989">
    <div class="banner-inner fill">
        <div class="banner-bg fill">
            <?php
            echo flatsome_get_image(431, $size = 'full', $alt = 'Mô tả hình ảnh', $inline = false, $image_title = false);
            ?>
            <div class="overlay"></div>
        </div>

        <div class="banner-layers container">
            <div class="fill banner-link"></div>
            <div id="text-box-1102703082" class="text-box banner-layer x50 md-x50 lg-x50 y50 md-y50 lg-y50 res-text">
                <div class="text-box-content text dark">

                    <div class="text-inner text-center2">
                        <?php
                        $category = get_the_category();
                        $category_name = $category[0]->cat_name;  // Lấy tên category hiện tại
                        echo '<h1 class="uppercase" style="font-size:24px">' . esc_html($category_name) . '</h1>';
                        ?>
                        <div class="is-divider divider clearfix" style="margin-top:0px;margin-bottom:0px;max-width:113px;background-color:rgb(255, 255, 255);"></div>
                    </div>
                </div>

                <style>
                    #text-box-1102703082 {
                        width: 60%;
                    }

                    #text-box-1102703082 .text-box-content {
                        font-size: 100%;
                    }
                </style>
            </div>

        </div>
    </div>

    <div class="height-fix is-invisible">
        <?php
        echo flatsome_get_image(431, $size = 'full', $alt = 'Mô tả hình ảnh', $inline = false, $image_title = false);
        ?>
    </div>

    <style>
        #banner-1613537989 .overlay {
            background-color: rgba(178, 44, 28, 0.837);
        }
    </style>
</div>

<?php if (!is_single() && flatsome_option('blog_featured') == 'top') {
    get_template_part('template-parts/posts/featured-posts');
} ?>

<div class="row row-small <?php if (flatsome_option('blog_layout_divider')); ?>">

    <div class="large-9 col">
        <?php if (!is_single() && flatsome_option('blog_featured') == 'content') {
            get_template_part('template-parts/posts/featured-posts');
        } ?>
        <?php
        if (is_single()) {
            get_template_part('template-parts/posts/single_new');
            comments_template();
        } elseif (flatsome_option('blog_style_archive') && (is_archive() || is_search())) {
            get_template_part('template-parts/posts/archive', flatsome_option('blog_style_archive'));
        } else {
            get_template_part('template-parts/posts/archive', flatsome_option('blog_style'));
        }
        ?>
    </div>
    <div class="post-sidebar large-3 col">
        <div class="row row-collapse hide-for-small" id="row-1202977745" style="margin-bottom:20px">
            <?php
            // Hiển thị nội dung của shortcode trong file PHP
            echo do_shortcode('[block id="block-img-single-post"]');
            ?>
        </div>
        <?php flatsome_sticky_column_open('blog_sticky_sidebar'); ?>
        <?php get_sidebar(); ?>
        <?php flatsome_sticky_column_close('blog_sticky_sidebar'); ?>
    </div>
</div>

<?php
do_action('flatsome_after_blog');
?>