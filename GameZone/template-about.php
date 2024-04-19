<?php
/*
Template Name: About Page Template
*/
get_header(); // Including the header
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    
        <div class="about-content">
        <!--Used short code as professor said in instruction-->
            <h2>About Us</h2>
            <?php echo do_shortcode('[game]'); ?>
        </div>
        <?php
        ?>
    </main>
</div>
<!--Including the footer-->
<?php get_footer();  ?>
