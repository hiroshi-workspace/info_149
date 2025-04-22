<?php

/**
 * Posts single.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

if (have_posts()) : ?>

    <?php /* Start the Loop */ ?>

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="article-inner <?php flatsome_blog_article_classes(); ?>">
                <div class="text-breadcrumb-singleblog">
                    <?php
                    $category = get_the_category();
                    $category_name = $category[0]->cat_name; // Lấy tên category hiện tại
                    $category_link = get_category_link($category[0]->term_id);
                    $separator_image = flatsome_get_image(1294, 'full', 'Separator', false, false);
                    echo '<h1 class="uppercase" style="font-size:16px; color:#B22C1C">';
                    echo '<a href="' . esc_url(home_url()) . '" class="blog-home-link" style="color:#B22C1C">Trang chủ</a>';
                    echo $separator_image;
                    echo '<a href="' . esc_url($category_link) . '" class="blog-category-link" style="color:#B22C1C">' . esc_html($category_name) . '</a>';
                    echo '</h1>';
                    ?>
                </div>
                <div class="text-inner">
                    <h1 class="post-title blog-title">
                        <?php the_title(); ?>
                    </h1>
                </div>
                <div class="comment-date">

                    <?php
                    echo flatsome_get_image(454, $size = 'full', $alt = 'Mô tả hình ảnh', $inline = false, $image_title = false);
                    ?>
                    <span class="from_the_blog_comments uppercase is-xsmall test" style="margin-right: 5px;">
                        <?php
                        $comments_number = get_comments_number(get_the_ID());
                        echo number_format_i18n($comments_number);
                        ?>

                    </span>

                    <span class="post-meta is-small op-8" style="margin-right: 5px;"><?php echo get_the_date('j-m-20y'); ?></span>
                    <span class="author-name">
                        <?php
                        $author_id = get_the_author_meta('ID');
                        $author_url = home_url('/tac-gia/?author_id=' . $author_id);
                        ?>
                        <a href="<?php echo $author_url ?>">
                            <?php echo __('Tham vấn bởi chuyên gia ') . get_the_author(); ?>
                    </span>
                    </a>
                </div>
                <?php
                // if (flatsome_option('blog_post_style') == 'default' || flatsome_option('blog_post_style') == 'inline') {
                //     get_template_part('template-parts/posts/partials/entry-header-new', flatsome_option('blog_posts_header_style'));
                // }
                ?>
                <?php get_template_part('template-parts/posts/content', 'single-new'); ?>
            </div>
        </article>


        <?php if (get_theme_mod('blog_author_box', 1)) : ?>
            <div class="entry-author author-box" style="background-color: #A53019; padding: 20px; border-radius: 10px; color: white;">
                <div class="flex-row align-top">
                    <div class="flex-col mr circle">
                        <div class="blog-author-image">
                            <?php echo get_avatar(get_the_author_meta('ID'), apply_filters('flatsome_author_bio_avatar_size', 170)); ?>
                        </div>
                    </div>
                    <div class="flex-col flex-grow">
                        <h5 class="author-name uppercase pt-half">
                            <?php echo __('TÁC GIẢ:'); ?> <?php the_author_meta('display_name'); ?>
                        </h5>
                        <p class="author-title"><?php echo __('CHUYÊN GIA THẨM ĐỊNH'); ?></p>
                        <?php
                        // Hiển thị nội dung của shortcode trong file PHP
                        echo do_shortcode('[divider width="112px" height="2px" margin="0px" color="rgb(255, 255, 255)"]');
                        ?>
                        <p class="author-desc small"><?php the_author_meta('description'); ?></p>



                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row row-collapse show-for-small" id="row-1202977745">
            <?php
            // Hiển thị nội dung của shortcode trong file PHP
            echo do_shortcode('[block id="block-img-single-post"]');
            ?>
        </div>




        <?php if (get_theme_mod('blog_share', 1)) {
            // SHARE ICONS
            echo '<div class="blog-share text-left">';
            echo __('CHIA SẺ LÊN: ');
            echo do_shortcode('[share]');
            echo '</div>';
        } ?>


        <div class="comment-count-blog" style="font-size: 16px;font-weight: 700; color:#B22C1C">
            BÌNH LUẬN (<?php
                        $comments_number = get_comments_number(get_the_ID());
                        echo number_format_i18n($comments_number);
                        ?>)
        </div>


    <?php endwhile; ?>

<?php else : ?>

    <?php get_template_part('no-results', 'index'); ?>

<?php endif; ?>