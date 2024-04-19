<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <!-- linked with css -->
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_stylesheet_uri() ); ?>?v=<?php echo time(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="masthead" class="site-header" role="banner">
    <div class="container">
        <div class="logo">GameZone</div> <!-- Logo div -->
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'header-menu',
                'menu_class'     => 'header-menu',
            ) );
            ?>
        </nav>
    </div>
</header>

