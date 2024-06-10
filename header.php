<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mota Photo</title>
    <?php wp_head() ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="body-all">
    <div class="max-wid">
        <header>
            <a href="<?php echo home_url(); ?>" class="logo">
                <img class="logo-nm" src="<?php echo get_template_directory_uri() . '/assets/images/logo-nathalie-mota.png'?>" alt="Logo du site de Nathalie Mota">
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
            <div id="openBtn" class="open-btn">
                <span class="burger-icon">
                    <span id="span-1"></span>
                    <span id="span-2"></span>
                    <span id="span-3"></span>
                </span>
            </div>
            <div id="closeBtn" class="close-btn">
                <span class="burger-icon">
                    <span id="span-4"></span>
                    <span id="span-5"></span>
                    <span id="span-6"></span>
                </span>
            </div>
        </header>