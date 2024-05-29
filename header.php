<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mota Photo</title>
    <?php wp_head() ?>
</head>
<body class="body-all">
    <div class="max-wid">
        <header>
            <a href="<?php echo get_template_directory_uri() . 'index.php'?>" class="logo">
                <img class="logo-nm" src="<?php echo get_template_directory_uri() . './assets/images/logo-nathalie-mota.png'?>" alt="Logo du site de Nathalie Mota">
            </a>
            <?php 
                wp_nav_menu( 
                    array( 
                        'theme_location' => 'main', 
                        'container' => 'ul', // afin d'éviter d'avoir une div autour 
                        'menu_class' => 'header-menu', // ma classe personnalisée 
                    )
                );
            ?>
        </header>