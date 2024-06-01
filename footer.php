        <?php get_template_part( 'templates_parts/modale' ); ?>
        <?php get_template_part( 'templates_parts/lightbox' ); ?>
        <footer>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('mentions-legales'))); ?>">Mentions Légales</a>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('vie-privee'))); ?>">Vie Privée</a>
            <p>Tous droits réservés</p>
        </footer>
        <?php wp_footer() ?>
    </div>
</body>
</html>