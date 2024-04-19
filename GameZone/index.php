<?php get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <!-- Linked css -->
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_stylesheet_uri() ); ?>?v=<?php echo time(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="masthead" class="site-header" role="banner">
</header>

<div class="main-content">
        <h1>"Unlock Adventures, One Game at a Time!"</h1>
        <p>At Game Zone, we're not just a store—we're a haven for gamers of all levels and interests. Founded by a passionate team of gaming enthusiasts, our mission is simple: to provide a one-stop shop for everything you need to elevate your gaming experience. What sets Game Zone apart? It's our unwavering dedication to delivering excellence in every aspect of the gaming world. From offering an extensive collection of the latest blockbuster titles to stocking hard-to-find classics, we're committed to catering to every gamer's taste and preference.</p>
        <a href="http://cms-class-2024.local/product/pride-and-prejudice/" class="shop-button">Shop now</a>
    </div>
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
        <div class="images-container">
            <!-- I added link for the image -->
            <!-- Thank You https://wallpapers.com/gaming for the image -->
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Game4.jpg" alt="First Image">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Game5.jpg" alt="Second Image">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Game6.jpg" alt="Third Image">
        </div>

        </div>
            <!-- Why GameZone? Section -->
            
                <div class="abt-home">
                    <h2>About Us</h2>
                    <p>At Game Zone, we're not just a store—we're a haven for gamers of all levels and interests. Founded by a passionate team of gaming enthusiasts, our mission is simple: to provide a one-stop shop for everything you need to elevate your gaming experience.
                    What sets Game Zone apart? It's our unwavering dedication to delivering excellence in every aspect of the gaming world. From offering an extensive collection of the latest blockbuster titles to stocking hard-to-find classics, we're committed to catering to every gamer's taste and preference.</p>

                    <p>But Game Zone is more than just a place to buy games. It's a community—a gathering place for gamers to connect, share tips and tricks, and forge lasting friendships. Dive into our forums, join our events, and become part of the Game Zone family.
                    With our user-friendly platform, seamless shopping experience, and top-notch customer service, we strive to make your journey with Game Zone as enjoyable and hassle-free as possible. Whether you're a console aficionado, a PC purist, or a mobile gaming enthusiast, you'll find exactly what you're looking for right here.</p>

                    <p>So, whether you're embarking on an epic quest, battling it out in the latest multiplayer sensation, or simply seeking to unwind with a captivating story, Game Zone is your trusted partner every step of the way.</p>
                    <div class="ab-btn">
                    <a href="http://cms-class-2024.local/contact/" class="shop-button">Contact us</a>
                </div>
                </div>
                

                
           
</br>
            
            <div class="entry-content">
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    // Include the page content template.
                   

                // End the loop.
                endwhile;
                ?>
            </div>
        </main>
    </div>
     <!-- Including the footer template -->
    <?php get_footer(); ?>
</body>
</html>
