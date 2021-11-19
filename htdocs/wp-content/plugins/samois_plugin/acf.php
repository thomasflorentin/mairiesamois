<?php

function samois_acf_load_json($paths) {
	$paths = array(
		SAMOIS_DIR.'/acf-json'
	);

	return $paths;
}

function samois_acf_save_json($paths) {

	$paths = SAMOIS_DIR.'/acf-json';

	return $paths;
}


add_filter('acf/settings/save_json', 'samois_acf_save_json');
add_filter('acf/settings/load_json', 'samois_acf_load_json');

add_filter('acf/save_post', function($post_id) {
	$format = function(&$date) {
		$tmp = sanitize_text_field($date);
		if(!empty($tmp)) {
			preg_match('~(\d{4})(\d{2})(\d{2})~', $tmp, $match);
			array_shift($match);
			$date = implode('-', $match);
		}
	};

	$format($_POST['acf']['field_58eb82d838d59']);
	$format($_POST['acf']['field_58eb835538d5a']);
}, 1, 1);



if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' => 'options',
		'menu_title' => 'Options',
		'icon_url' => 'dashicons-layout',
		'position' => 2
	));

}