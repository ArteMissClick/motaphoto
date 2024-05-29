<?php get_header() ?>

<div class="single-photo">
    <article class="photo-article">
        <div class="photo-descpic">
            <div class="photo-desc">
                <h2 class="desc-item photo-title"><?php the_title() ?> </h2>
                <p class="desc-item">Référence : <span id="maReference"><?php the_field( 'reference' ) ?></span></p>
                <p class="desc-item">Catégorie : <?php the_terms( get_the_ID() , 'categorie' ) ?></p>
                <p class="desc-item">Format : <?php the_terms( get_the_ID() , 'format' ) ?></p>
                <p class="desc-item">Type : <?php the_field( 'type' ) ?></p>
                <p class="desc-item">Année : <?php the_terms( get_the_ID() , 'date' ) ?></p>
            </div>
            <div class="photo-picture">
                <img class="img-photo" src="<?php the_field( 'photo' ) ?>" alt="Team Mariée">
            </div>
        </div>
        <div class="photo-bottom">
            <div class="photo-btm-left">
                <p>Cette photo vous intéresse ?</p>
                <button class="grey-button" id="singleContact" type="button">Contact</button>
            </div>
            <div class="photo-btm-right">
                <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();

                    if ( $prev_post ) :
                        $prev_photo = get_field( 'photo', $prev_post->ID );
                    endif;

                    if ( $next_post ) :
                        $next_photo = get_field( 'photo', $next_post->ID );
                    endif;
                ?>

                <?php if ( $prev_post ) : ?>
                    <img class="photo-prev" src="<?php echo esc_url( $prev_photo ); ?>" alt="Photo précédente">
                <?php endif; ?>

                <?php if ( $next_post ) : ?>
                    <img class="photo-next" src="<?php echo esc_url( $next_photo ); ?>" alt="Photo suivante">
                <?php endif; ?>

                <div class="arrows arrows-alone">
                    <?php
                        the_post_navigation(
                            array(
                                'next_text' => '<img class="arrow arrow-right" src="' . get_template_directory_uri() . '/assets/images/arrow_right.svg" alt="Flèche droite">',
                                'prev_text' => '<img class="arrow arrow-left" src="' . get_template_directory_uri() . '/assets/images/arrow_left.svg" alt="Flèche gauche">',
                            )
                        );
                    ?>
                </div>
            </div>
        </div>
    </article>
    <?php get_template_part( 'templates_parts/photo_block' ); ?>
</div>

<?php get_footer() ?>






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
                <img class="img-photo" src="<?php the_field('photo'); ?>" alt="Team Mariée">
            </div>
        </div>
        <div class="photo-bottom">
            <div class="photo-btm-left">
                <p>Cette photo vous intéresse ?</p>
                <button class="grey-button" id="singleContact" type="button">Contact</button>
            </div>
            <div class="photo-btm-right">
                <?php
                // Récupérer tous les posts de type 'photo' dans l'ordre de la date de prise de vue
                $args = array(
                    'post_type' => 'photo',
                    'posts_per_page' => -1,
                    'meta_key' => 'date',
                    'orderby' => 'meta_value',
                    'order' => 'ASC'
                );
                $all_photos = new WP_Query($args);

                // Extraire les IDs de tous les posts
                $photo_ids = wp_list_pluck($all_photos->posts, 'ID');

                // Trouver l'index du post actuel
                $current_post_index = array_search(get_the_ID(), $photo_ids);

                // Calculer les IDs des posts précédent et suivant
                $prev_post_id = $photo_ids[$current_post_index - 1] ?? end($photo_ids);
                $next_post_id = $photo_ids[$current_post_index + 1] ?? reset($photo_ids);

                // Récupérer les champs personnalisés des posts précédent et suivant
                $prev_photo = get_field('photo', $prev_post_id);
                $next_photo = get_field('photo', $next_post_id);
                ?>

                <img class="photo-prev" src="<?php echo esc_url($prev_photo); ?>" alt="Photo précédente">
                <img class="photo-next" src="<?php echo esc_url($next_photo); ?>" alt="Photo suivante">

                <div class="arrows arrows-alone">
                    <a href="<?php echo get_permalink($prev_post_id); ?>">
                        <img class="arrow arrow-left" src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_left.svg" alt="Flèche gauche">
                    </a>
                    <a href="<?php echo get_permalink($next_post_id); ?>">
                        <img class="arrow arrow-right" src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_right.svg" alt="Flèche droite">
                    </a>
                </div>
            </div>
        </div>
    </article>
    <?php get_template_part('templates_parts/photo_block'); ?>
</div>

<?php get_footer(); ?>





            <!-- <div>
                <img class="img-photo" src="./../../motaphoto/wp-content\uploads\2024\05\nathalie-5-min-683x1024.jpeg" alt="Team Mariée">
            </div>
            <div>
                <img class="img-photo" src="./../../motaphoto/wp-content\uploads\2024\05\nathalie-14-min-683x1024.jpeg" alt="Team Mariée">
            </div>
            <div>
                <img class="img-photo" src="./../../motaphoto/wp-content\uploads\2024\05\nathalie-13-min-683x1024.jpeg" alt="Team Mariée">
            </div>
            <div>
                <img class="img-photo" src="./../../motaphoto/wp-content\uploads\2024\05\nathalie-12-min-768x512.jpeg" alt="Team Mariée">
            </div>
            <div>
                <img class="img-photo" src="./../../motaphoto/wp-content\uploads\2024\05\nathalie-11-min-768x513.jpeg" alt="Team Mariée">
            </div>
            <div>
                <img class="img-photo" src="./../../motaphoto/wp-content\uploads\2024\05\nathalie-10-min-768x576.jpeg" alt="Team Mariée">
            </div>
            <div>
                <img class="img-photo" src="./../../motaphoto/wp-content\uploads\2024\05\nathalie-9-min-768x512.jpeg" alt="Team Mariée">
            </div>
            <div>
                <img class="img-photo" src="./../../motaphoto/wp-content\uploads\2024\05\nathalie-8-min-684x1024.jpeg" alt="Team Mariée">
            </div> -->