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
$projects = new PostType('recipe', $options);

// Add the Status Taxonomy
$projects->taxonomy('type');
$projects->taxonomy('duration');
$projects->taxonomy('difficulty');

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
$type = new Taxonomy('type');
$duration = new Taxonomy('duration');
$difficulty = new Taxonomy('difficulty');

// Add a popularity column to the type taxonomy
$type->columns()->add([
    'type' => 'Type'
]);

$duration->columns()->add([
    'duration' => 'Duration'
]);

$difficulty->columns()->add([
    'difficulty' => 'Difficulty'
]);


// Populate the type column
$type->columns()->populate('type', function($content, $column, $term_id) {
    return get_term_meta($term_id, 'type', true);
});

// Populate the duration column
$duration->columns()->populate('duration', function($column, $post_id) {
	return get_term_meta($term_id, 'duration', true);
});

// Populate the difficulty column
$difficulty->columns()->populate('difficulty', function($column, $post_id) {
	return get_term_meta($term_id, 'difficulty', true);
});

// Register the taxonomy to WordPress
$type->register();
$duration->register();
$difficulty->register();