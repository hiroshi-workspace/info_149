<?php
function display_custom_single_product_shortcode()
{
	// Get the product ID
	$product_id = get_the_ID();

	// Get the product object from WooCommerce
	$product = wc_get_product($product_id);

	// Get the product ID
	$loai = get_field('loai_nha');
	$size = get_field('dien_tich');
	$location = get_field('location');
	$type = get_field('the_loai');


	// Generate HTML table
	$html = '
    <div class="local">' . esc_html($location) . '</div>
    <div class="custom-single-product">
		<div class="d-flex align-items-center">
			<i class="fa-solid fa-user"></i> <span class="ps-2">' . esc_html($loai) . '</span>
		</div>
		<span class="px-3 text-black-50">/</span>
		<div class="d-flex align-items-center">
			<i class="fa-solid fa-folder-closed"></i> <span class="ps-2">' . esc_html($size) . 'm2</span>
		</div>
		<span class="px-3 text-black-50">/</span>
		<div class="d-flex align-items-center">
			<i class="fa-solid fa-folder-closed"></i><span class="ps-2">' . esc_html($type) . '</span>
		</div>
	</div>';

	return $html;
}

add_shortcode('custom_single_product', 'display_custom_single_product_shortcode');

function display_product_description_shortcode()
{
	// Get the product ID
	$product_id = get_the_ID();

	// Get the product object from WooCommerce
	$product = wc_get_product($product_id);

	// Get ACF fields
	$year = get_field('project_year');
	$investor = get_field('investors');
	$name = get_field('project_name');
	$location = get_field('location');

	// Generate HTML table
	$html = '
    <div class="table-description-product">
		<table>
            <tr>
                <th style="padding: 10px; text-align: center; color: #d9a555;">Project Year</th>
                <th style="padding: 10px; text-align: center; color: #d9a555;">Investor</th>
                <th style="padding: 10px; text-align: center; color: #d9a555;">Project Name</th>
                <th style="padding: 10px; text-align: center; color: #d9a555;">Location</th>
            </tr>
            <tr>
                <td style="color:white;padding: 10px; text-align: center">' . esc_html($year) . '</td>
                <td style="color:white;padding: 10px; text-align: center">' . esc_html($investor) . '</td>
                <td style="color:white;padding: 10px; text-align: center">' . esc_html($name) . '</td>
                <td style="color:white;padding: 10px; text-align: center">' . esc_html($location) . '</td>
            </tr>
        </table>
    </div>';

	$htmls = '
	<div class="project-bar">
		<div class="row justify-content-between align-items-center text-left text-lg-start">
			<div class="col medium-3 small-12 large-3">
				<h5>Project Year</h5>
				<h6 style="color: #999;font-weight: 400;">' . esc_html($year) . '</h6>
			</div>
			<div class="col medium-3 small-12 large-3">
				<h5>Investor</h5>
				<h6 style="color: #999;font-weight: 400;">' . esc_html($investor) . '</h6>
			</div>
			<div class="col medium-3 small-12 large-3">
				<h5>Project Name</h5>
				<h6 style="color: #999;font-weight: 400;">' . esc_html($name) . '</h6>
			</div>
			<div class="col medium-3 small-12 large-3">
				<h5>Location</h5>
				<h6 style="color: #999;font-weight: 400;">' . esc_html($location) . '</h6>
			</div>
		</div>
	</div>
	';

	return $htmls;
}

add_shortcode('custom_product_description', 'display_product_description_shortcode');
