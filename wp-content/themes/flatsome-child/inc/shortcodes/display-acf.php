<?php
function display_product_specs_table()
{
    // $id_post = get_the_title();

    // Get the product ID
    $loai = get_field('loai_nha');
    var_dump($loai);
    $size = get_field('dien_tich');

    $type = get_field('the_loai');


    // Generate HTML table
    $html = '
    <div style=" width: 60%;position: absolute;top: 50%;
    /* overflow: hidden;;">
        <table style="    width: 110%;
    border-collapse: collapse;
    background-color: #111;
    color: #fff;
    height: 105px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
">
            <tr>
                <th style="padding: 10px; text-align: center; color: #d9a555;">Year</th>
                <th style="padding: 10px; text-align: center; color: #d9a555;">Company</th>
                <th style="padding: 10px; text-align: center; color: #d9a555;">Name</th>
                <th style="padding: 10px; text-align: center; color: #d9a555;">Location</th>
            </tr>
            <tr>
                <td style="color:white;padding: 10px; text-align: center">' . esc_html($loai) . '</td>
                <td style="color:white;padding: 10px; text-align: center">' . esc_html($size) . '</td>
                <td style="color:white;padding: 10px; text-align: center">' . esc_html($type) . '</td>
            </tr>
        </table>
    </div>';

    return $html;
}

add_shortcode('product_specs', 'display_product_specs_table');
