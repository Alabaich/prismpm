<?php
/* Template Name: Single Property */




get_header();

// Get the current URL
$current_url = home_url(add_query_arg([]));

// Parse the URL
$parsed_url = wp_parse_url($current_url);

// Parse query string
parse_str($parsed_url['query'] ?? '', $query_params);

// Get 'arg'
$arg = $query_params['arg'] ?? null;


?>

<h1>HERE</h1>



<?php 

get_footer();