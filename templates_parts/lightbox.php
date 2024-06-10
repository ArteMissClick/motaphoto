
<div id="lightbox" class="lightbox">
    <img class="close-lightbox contain-nav-lightbox" src="<?php echo get_template_directory_uri() . '/assets/images/lightbox_close.svg'?>">
    <div class="contain-nav-lightbox contain-right">
      <button class="next-lightbox nav-lightbox">Suivante</button>
      <img class="img-next img-nav" src="<?php echo get_template_directory_uri() . '/assets/images/arrow_right.svg'?>">
    </div>
    <div class="contain-nav-lightbox contain-left">
      <button class="prev-lightbox nav-lightbox">Précédente</button>
      <img class="img-prev img-nav" src="<?php echo get_template_directory_uri() . '/assets/images/arrow_left.svg'?>">
    </div>
    <div class="lightbox-container">
        <img id="lightbox-image" class="lightbox-image" src="" alt="Lightbox Image">
        <div class="lightbox-info">
          <span class="hover-ref comp-hover"><?php the_field('reference'); ?></span>
          <span class="hover-cat comp-hover"><?php the_terms(get_the_ID(), 'categorie'); ?></span>
        </div>
    </div>
</div>
