<?php get_header(); ?> <!-- Including the header -->

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        //page cart content
        echo do_shortcode('[woocommerce_cart]'); // Displaying the WooCommerce cart using shortcode
        ?>
    </main>
</div>

<?php get_footer(); ?> <!-- Including the footer -->
