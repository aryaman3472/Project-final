<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Checkout page content
        echo do_shortcode('[woocommerce_checkout]');
        ?>
    </main>
</div>
<?php get_footer(); ?>
