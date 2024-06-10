<div class="photo-block">
    <div class="hover-photo">
        <img class="eyes comp-hover" src="<?php echo get_template_directory_uri() . '/assets/images/icon_eye.svg'?>" data-url="<?php echo get_permalink(); ?>">
        <img class="show-photo comp-hover" src="<?php echo get_template_directory_uri() . '/assets/images/icon_fullscreen.svg'?>"
             data-reference="<?php echo esc_attr(get_field('reference')); ?>"
             data-categorie="<?php echo esc_attr(implode(', ', wp_list_pluck(get_the_terms(get_the_ID(), 'categorie'), 'name'))); ?>">
        <span class="hover-ref comp-hover"><?php the_field('reference'); ?></span>
        <span class="hover-cat comp-hover"><?php the_terms(get_the_ID(), 'categorie'); ?></span>
    </div>
    <div class="photo-block-wrapper">
        <img class="other-photo photo-block-image" src="<?php the_field('photo-unique') ?>" alt="Autre photo">
    </div>
</div>