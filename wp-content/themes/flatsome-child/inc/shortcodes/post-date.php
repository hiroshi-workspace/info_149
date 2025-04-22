<?php
function post_date_shortcode(){
    // Lấy ID của bài viết hiện tại
    $post_id = get_the_ID();

    // Lấy ngày chỉnh sửa
    $modified_date = get_the_modified_date('d/m/Y', $post_id);

    // Lấy ngày đăng
    $published_date = get_the_date('d/m/Y', $post_id);

    // hiển thị ngày chỉnh sửa hoặc ngày đăng.
    if ($modified_date !== $published_date)
    {
        return $modified_date;
    }else {
        return $published_date;
    }
}

// Đăng ký shortcode
add_shortcode('post_date','post_date_shortcode');