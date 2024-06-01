<?php

/**
 * Proper ob_end_flush() for all levels
 *
 * This replaces the WordPress `wp_ob_end_flush_all()` function
 * with a replacement that doesn't cause PHP notices.
 */
remove_action('shutdown', 'wp_ob_end_flush_all', 1);
add_action('shutdown', function() {
    while (@ob_end_flush());
});

/**
 * Register and enqueue scripts and styles.
 */
function motaphoto_register_assets() {
    wp_enqueue_script('jquery');
    wp_enqueue_style('style-mota', get_stylesheet_uri());
    wp_enqueue_script('script-mota', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'motaphoto_register_assets');

/**
 * Register navigation menus.
 */
register_nav_menus(array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de page',
));

/**
 * Enqueue AJAX script for the homepage.
 */
function motaphoto_enqueue_scripts() {
    wp_enqueue_script('motaphoto-ajax', get_template_directory_uri() . '/js/ajax.js', array('jquery'), null, true);
    wp_localize_script('motaphoto-ajax', 'motaphoto_ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_scripts');

/**
 * AJAX handler for loading more photos.
 */
function load_more_photos() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    error_log('Requested page: ' . $paged); // Log the requested page number

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $paged,
    );

    if (isset($_POST['category']) && $_POST['category'] != '') {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $_POST['category']
        );
    }

    if (isset($_POST['format']) && $_POST['format'] != '') {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $_POST['format']
        );
    }

    if (isset($_POST['sort']) && $_POST['sort'] != '') {
        if ($_POST['sort'] == 'date_desc') {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        } elseif ($_POST['sort'] == 'date_asc') {
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
        }
    }

    $query = new WP_Query($args);
    if ($query->have_posts()) :
        error_log('Loaded posts for page ' . $paged . ':'); // Log the posts loaded for this page
        while ($query->have_posts()) : $query->the_post();
            error_log('Loaded post ID: ' . get_the_ID()); // Log each loaded post ID
            get_template_part('templates_parts/photo_block');
        endwhile;
        wp_reset_postdata();
    else :
        echo 'no_more_photos';
    endif;

    die();
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

/**
 * Get a random photo background.
 */
function get_random_photo_background() {
    // Query to get all 'photo' custom post types
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1, // Get all posts
    );
    $query = new WP_Query($args);
    
    // Array to hold image URLs
    $images = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Get the custom field value (image URL)
            $image_url = get_field('photo-unique'); // Replace 'your_image_field_name' with your actual field name
            if ($image_url) {
                $images[] = $image_url;
            }
        }
        wp_reset_postdata();
    }

    // Check if there are any images
    if (!empty($images)) {
        // Get a random image from the array
        $random_image = $images[array_rand($images)];
        return $random_image;
    }

    return ''; // Return an empty string if no images found
}

?>