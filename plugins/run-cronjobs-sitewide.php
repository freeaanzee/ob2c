<?php

// Laad de WordPress-omgeving (relatief pad geldig vanuit domeinmap)
require_once dirname(__FILE__).'/public_html/wp-load.php';

$args = array( 'public' => 1 );
$blogs = get_sites( $args );

global $wp_version;
$agent = 'WordPress/' . $wp_version . '; ' . home_url();

// Run cron on each blog
foreach ( $blogs as $blog ) {
	$domain = $blog->domain;
	$path = $blog->path;
	$command = "https://" . $domain . ( $path ? $path : '/' ) . 'wp-cron.php?doing_wp_cron';

	$rc = shell_exec( dirname(__FILE__) . ( $path ? $path : '/' ) . 'public_html/wp-cron.php?doing_wp_cron' );
	
	// $ch = curl_init( $command );
	// $rc = curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
	// $rc = curl_exec( $ch );
	// curl_close( $ch );

	print_r( $rc );
	print_r( "\t✔ " . $command . PHP_EOL );
}

?>