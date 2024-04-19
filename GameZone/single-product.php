<!-- Single product page-->
<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) : the_post();
            // Single product content
            the_title('<h1>', '</h1>');
            the_content();
        endwhile;
        ?>
    </main>
</div>
<?php get_footer(); ?>




