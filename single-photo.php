<?php get_header(); ?>

<div class="single-photo">
    <article class="photo-article">
        <div class="photo-descpic">
            <div class="photo-desc">
                <h2 class="desc-item photo-title"><?php the_title(); ?></h2>
                <p class="desc-item">Référence : <span id="maReference"><?php the_field('reference'); ?></span></p>
                <p class="desc-item">Catégorie : <?php the_terms(get_the_ID(), 'categorie'); ?></p>
                <p class="desc-item">Format : <?php the_terms(get_the_ID(), 'format'); ?></p>
                <p class="desc-item">Type : <?php the_field('type'); ?></p>
                <p class="desc-item">Année : <?php the_terms(get_the_ID(), 'date'); ?></p>
            </div>
            <div class="photo-picture">
                <img class="img-photo" src="<?php the_field('photo-unique'); ?>" alt="">
            </div>
        </div>
        <div class="photo-bottom">
            <div class="photo-btm-left">
                <p>Cette photo vous intéresse ?</p>
                <button class="grey-button" id="singleContact" type="button">Contact</button>
            </div>
            <div class="photo-btm-right">
                <?php
                // Récupérer tous les posts de type 'photo' ordonnés par une taxonomie personnalisée 'date'
                $args = array(
                    'post_type' => 'photo',  // Type de post 'photo'
                    'posts_per_page' => -1,  // Nombre de posts par page (-1 pour tous les posts)
                    'orderby' => 'tax_query',  // Utiliser 'tax_query' pour ordonner par taxonomie personnalisée
                    'order' => 'ASC',  // Ordre ascendant
                    'tax_query' => array(  // Query de taxonomie
                        array(
                            'taxonomy' => 'date',  // Nom de la taxonomie personnalisée 'date'
                            'field'    => 'term_id',  // Champ utilisé pour la query (ici 'term_id')
                            'terms'    => get_terms(array('taxonomy' => 'date', 'fields' => 'ids')),  // Termes de la taxonomie 'date'
                        ),
                    ),
                );
                $all_photos = new WP_Query($args);

                if ($all_photos->have_posts()) {
                    // Extraire les IDs de tous les posts
                    $photo_ids = wp_list_pluck($all_photos->posts, 'ID');

                    // Trouver l'index du post actuel
                    $current_post_index = array_search(get_the_ID(), $photo_ids);

                    // Calculer les indices des posts précédent et suivant
                    $prev_post_index = ($current_post_index - 1 + count($photo_ids)) % count($photo_ids);
                    $next_post_index = ($current_post_index + 1) % count($photo_ids);

                    // Récupérer les IDs des posts précédent et suivant
                    $prev_post_id = $photo_ids[$prev_post_index];
                    $next_post_id = $photo_ids[$next_post_index];

                    // Récupérer les champs personnalisés des posts précédent et suivant
                    $prev_photo = get_field('photo-unique', $prev_post_id);
                    $next_photo = get_field('photo-unique', $next_post_id);
                ?>

                    <div class="photos-arrow">
                        <?php if ($prev_photo) : ?>
                            <img class="photo-prev" src="<?php echo esc_url($prev_photo); ?>" alt="Photo précédente">
                        <?php endif; ?>
                        <?php if ($next_photo) : ?>
                            <img class="photo-next" src="<?php echo esc_url($next_photo); ?>" alt="Photo suivante">
                        <?php endif; ?>
                    </div>

                    <div class="arrows arrows-alone">
                        <a href="<?php echo get_permalink($prev_post_id); ?>" class="arrow-left">
                            <img class="arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_left.svg" alt="Flèche gauche">
                        </a>
                        <a href="<?php echo get_permalink($next_post_id); ?>" class="arrow-right">
                            <img class="arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_right.svg" alt="Flèche droite">
                        </a>
                    </div>
                <?php
                } else {
                    echo '<p>No photos found.</p>';
                }
                ?>
            </div>
        </div>
    </article>

    <?php
// Récupérez les catégories du post actuel
$categories = get_the_terms( get_the_ID(), 'categorie' );

if ( $categories && ! is_wp_error( $categories ) ) {
    $category_ids = wp_list_pluck( $categories, 'term_id' );

    // WP_Query pour récupérer les autres posts avec les mêmes catégories
    $related_args = array(
        'post_type' => 'photo',
        'posts_per_page' => 2, // Nombre de posts à afficher
        'post__not_in' => array( get_the_ID() ), // Exclure le post actuel
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field' => 'id',
                'terms' => $category_ids,
                'operator' => 'IN',
            ),
        ),
        'orderby' => 'rand' // Ajout de l'ordre aléatoire
    );

    $related_query = new WP_Query( $related_args );

    if ( $related_query->have_posts() ) {

        ?>
        <div class="like-too">
            <p>Vous aimerez aussi</p>
            <div class="photo-like-too">
        <?php

        while ( $related_query->have_posts() ) {
            $related_query->the_post();
            ?>
    <?php get_template_part('templates_parts/photo_block'); ?>

    <?php
        }
        wp_reset_postdata();
        ?>
            </div>
        </div>
        <?php
    }
}
?>
</div>

<?php get_footer(); ?>