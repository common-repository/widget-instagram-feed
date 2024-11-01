<?php

function wif_list_options($atts, $content = null) {
	global $wif_options;

	$atts = shortcode_atts(array(
		'title' => 'Instagram Photo List',
		'count' => 20
	), $atts);

	$url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $wif_options['access_token'] . '&count=' . $atts['count'];

	// var_dump($wif_options);

	$options = array('http' => array('user_agent' => $_SERVER['HTTP_USER_AGENT']));
	$context = stream_context_create($options);
	$response = file_get_contents($url, false, $context);
	$data = json_decode($response)->data;

	$output = '<div class="wif-photos">';
	$output .= '<p>' . $wif_options['page_caption'] . '</p>';

	foreach ($data as $photo) {
		$output .= '<div class="photo-col">';
		if ($wif_options['linked']) {
			$output .= '<a href="' . $photo->link . '" target="_blank"> <img src="' . $photo->images->standard_resolution->url . '"> </a> ';
		} else {
			$output .= '<img src="' . $photo->images->standard_resolution->url . '">';
		}
		$output .= '</div>';
	}
	$output .= '</div>';

	echo $output;
}

add_shortcode('photos', 'wif_list_options');
