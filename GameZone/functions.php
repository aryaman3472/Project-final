<?php
// Enqueue styles
function gamezone_theme_enqueue_styles() {
    wp_enqueue_style( 'gamezone-theme-style', get_template_directory_uri() . '/style.css' ); 
}
add_action( 'wp_enqueue_scripts', 'gamezone_theme_enqueue_styles' );

// Theme setup
function gamezone_theme_setup() {
    // Added support for WooCommerce so it works
    add_theme_support( 'woocommerce' );
}
//Custom post-type to offer a unique function that is not offered by wordpress

//Thanks https://developer.wordpress.org/reference/functions/register_post_type/ for the reference for the code
function gamezone_custom_post_game() {
	$labels = array(
		'name'                  => __( 'game'),
		'singular_name'         => __( 'game' ),
		'menu_name'             => __( 'game'),
		'name_admin_bar'        => __( 'game',),
		'add_new'               => __( 'Add New'),
		'add_new_item'          => __( 'Add New game'),
		'new_item'              => __( 'New game'),
		'edit_item'             => __( 'Edit game'),
		'view_item'             => __( 'View game'),
		'all_items'             => __( 'All game'),
		'search_items'          => __( 'Search game'),
		'parent_item_colon'     => __( 'Parent game:'),
		'not_found'             => __( 'No game found.'),
		'not_found_in_trash'    => __( 'No game found in Trash.'),
		'featured_image'        => __( 'game Cover Image'),
		'set_featured_image'    => __( 'Set cover image'),
		'remove_featured_image' => __( 'Remove cover image'),
		'use_featured_image'    => __( 'Use as cover image'),
		'archives'              => __( 'game archives'),
		'insert_into_item'      => __( 'Insert into game'),
		'uploaded_to_this_item' => __( 'Uploaded to this game'),
		'filter_items_list'     => __( 'Filter game list'),
		'items_list_navigation' => __( 'game list navigation'),
		'items_list'            => __( 'game list'),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'game' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
	);

	register_post_type( 'game', $args );
}

add_action( 'init', 'gamezone_custom_post_game' );

add_action('init', 'gamezone_create_game_category');
function gamezone_create_game_category(){
        register_taxonomy(
                'game_category',
                'game',
                array(
                        'label' => __('game Category'),
                        'rewrite' => array ('Slug' => 'game_category'),
                        'hierarchical' => true,
                )
                );
}
function game_shortcode(){
	$query = new WP_Query(array('post_type' => 'game', 'post_per_page' => 15, 'order' => 'asc'));
	while ($query -> have_posts()) : $query-> the_post(); 
	$url = wp_get_attachment_url(get_post_thumbnail_id($query->ID), "thumbnail");
	?>
			<div class="game-a">
					<div class="game-body">
						<div class="small text-muted"><?php the_date();?></div>
						<h2 class="game-title"><?php the_title(); ?></h2>
						<p class="game-text"><?php the_content(); ?></p>
						<a href="<?php echo the_permalink()?>" class="btn btn-primary">Read More</a>
					</div>
				</div>
		<?php wp_reset_postdata(); ?>
	<?php
	endwhile;
	wp_reset_postdata();
}
//added shortcode
add_shortcode('game', 'game_shortcode');

add_filter( 'excerpt_length', function($length) {
	return 25;
}, PHP_INT_MAX );
?>