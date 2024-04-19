<?php
/*
Template Name: Contact Page Template
*/
get_header(); // Including the header
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    
        <div class="about-content">
            <h2>Contact Us</h2>
            <?php
        echo do_shortcode('[wpforms id="88"]'); // Displaying the Contact Page using shortcode
        ?>
        </div>
        <?php
        ?>
    </main>
</div>

<?php get_footer(); // Including the footer ?>
