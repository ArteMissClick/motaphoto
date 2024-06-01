<?php get_header() ?>

<div class="main-page">
    <?php
    // Get a random image URL
    $hero_background_image = get_random_photo_background();
    ?>
    <div class="hero" style="background-image: url('<?php echo esc_url($hero_background_image); ?>');">
        <h1>Photograph Event</h1>
    </div>
    <div class="all-main">
        <div class="filters">
            <div class="first-filters">
                <select class="category-filter filter-select" id="category-filter">
                    <option value="">Catégories</option>
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'categorie',
                        'hide_empty' => false,
                    ));
                    if (!is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                        }
                    } else {
                        echo '<option value="">Erreur de récupération des catégories</option>';
                    }
                    ?>
                </select>

                <select class="format-filter filter-select" id="format-filter">
                    <option value="">Formats</option>
                    <?php
                    $formats = get_terms(array(
                        'taxonomy' => 'format',
                        'hide_empty' => false,
                    ));
                    if (!is_wp_error($formats)) {
                        foreach ($formats as $format) {
                            echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
                        }
                    } else {
                        echo '<option value="">Erreur de récupération des formats</option>';
                    }
                    ?>
                </select>
            </div>

            <select class="sort-filter filter-select" id="sort-filter">
                <option value="">Trier par</option>
                <option value="date_desc">A partir des plus récentes</option>
                <option value="date_asc">A partir des plus anciennes</option>
            </select>
        </div>

        <div class="photo-gallery" id="photo-gallery">
            <?php
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 8,
                'tax_query' => array(
                    'relation' => 'AND',
                ),
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    get_template_part('templates_parts/photo_block');
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No photos found</p>';
            endif;
            ?>
        </div>
        <button class="grey-button" id="load-more">Charger plus</button>
        <div class="no-more-photos" id="no-more-photos" style="display: none;">Vous avez atteint la fin de la liste</div>
    </div>
</div>


<?php get_footer() ?>