<?php

use PostTypes\PostType;
use PostTypes\Taxonomy;

// Post type options
$options = [
	'supports' => [ 'title', 'editor', 'page-attributes', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields' ],
	'capability_type' => 'page',
	'hierarchical'       => false,
	'menu_position'      => null,
	'show_in_rest'       => true,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'can_export'         => true,
	'show_in_nav_menus'  => true,
	'query_var'          => true,
	'has_archive'        => true,
	'show_in_rest' => true,
];

// Register post type
$projects = new PostType('projet', $options);

// Add the Status Taxonomy
$projects->taxonomy('state');
$projects->taxonomy('technology');
$projects->taxonomy('context');

// add a tech and context column
$projects->columns()->add([
	'post_id' => __('Post Id'),
]);

// Populate the post_id column
$projects->columns()->populate('post_id', function($column, $post_id) {
	echo $post_id;
});



// Set sortable columns
$projects->columns()->sortable([
	'post_id' => ['post_id', true]
]);

// Set post type dashicon from Dashicons: https://developer.wordpress.org/resource/dashicons/#chart-bar
$projects->icon('dashicons-book-alt');

// Register the "Project" post type with WordPress
$projects->register(); 

// Create the genre Taxonomy
$status = new Taxonomy('state');
$techs = new Taxonomy('technology');
$contexts = new Taxonomy('context');

// Add a popularity column to the type taxonomy
$status->columns()->add([
    'popularity' => 'Popularity'
]);

$techs->columns()->add([
    'technology' => 'Technology'
]);

$contexts->columns()->add([
    'context' => 'Context'
]);


// Populate the new column
$status->columns()->populate('popularity', function($content, $column, $term_id) {
    return get_term_meta($term_id, 'popularity', true);
});

// Populate the tech column
$techs->columns()->populate('tech', function($column, $post_id) {
	return get_term_meta($term_id, 'tech', true);
});

// Populate the context column
$contexts->columns()->populate('context', function($column, $post_id) {
	return get_term_meta($term_id, 'context', true);
});

// Register the taxonomy to WordPress
$status->register();
$techs->register();
$contexts->register();