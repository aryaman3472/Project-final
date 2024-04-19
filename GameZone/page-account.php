<?php
/*
Template Name: Account Page
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>

            <div class="entry-content">
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    // Include the page content template.
                    the_content();

                // End the loop.
                endwhile;
                ?>
            </div>

        </article>

    </main>
</div>

<?php get_footer(); ?>
