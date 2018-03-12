<?php
/*
Plugin Name: Site Traffic Trend
Plugin URI: http://www.korablev.org/site-traffic-trend/
Description: Adds rankarchive.com trend to the Dashboard for current domain. The trend shows Alexa traffic rank history for period makes it convenient to see how is your site grow. * - Activate plugin and enter your site domain at http://www.rankarchive.com site to include it. If your site was not included you have to wait two days and Dashboard widget will show the collected statistic. 
Version: 1.0.2
Author: Alexey Korablev
Author URI: http://www.korablev.org/
*/

function rankarchive_output() {
	global $current_user, $screen_layout_columns;
	if($current_user->user_level==10) {
    	if ( empty($screen_layout_columns) ) $screen_layout_columns = 4;
        if ($screen_layout_columns==1) {$m=250; $l=1;}
        if ($screen_layout_columns==2) {$m=100; $l=30;}
        if ($screen_layout_columns==3) {$m=50; $l=0;}
        if ($screen_layout_columns==4) {$m=1; $l=0;}

        $screenr=900+$screen_layout_columns*$m;
        $css = round($screenr/$screen_layout_columns, 0);
        $domain = str_ireplace('www.', '', parse_url(get_site_url(), PHP_URL_HOST));


    ini_set("allow_url_fopen", true);
    $fgcontent=@file_get_contents('http://www.rankarchive.com/api_draw.php?d='.$domain.'&w='.$css.'&l='.$l, 1);
    if ($fgcontent) {echo $fgcontent;} else {
    //echo 'Sorry. Your hosting is not supporting URL open.';
    echo '<iframe src="http://www.rankarchive.com/api_draw.php?d='.$domain.'&w='.$css.'&l='.$l.'" scrolling="no" width="'.$css.'" height="350" frameborder="0"></iframe>';
    }
  }
}

function add_rankarchive_widget() {
    wp_add_dashboard_widget('dashboard_rankarchive', __('Rank Archive'), 'rankarchive_output');
}

function rankarchive_init() {
    // it is for future updates...
    $options = get_option('rankarchive_saved');
	if(!isset($options['domain_name'])) {
		$options['domain_name']='rankarchive.com';
		update_option('rankarchive_saved', $options);
	}
}

add_action('init', 'rankarchive_init');
add_action('wp_dashboard_setup','add_rankarchive_widget');

?>