<?php
if (!defined('ABSPATH')) exit;
get_header();
?>
<section class="curso-detalhes">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article class="curso-main-content">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <div class="entry-content"><?php the_content(); ?></div>
                <?php wp_link_pages(); ?>
            </article>
        <?php endwhile; ?>
    </div>
</section>
<?php get_footer(); ?>
