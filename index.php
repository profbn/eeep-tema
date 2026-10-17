<?php get_header(); ?>
<h1><?php single_post_title(); ?></h1>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div><?php the_content(); ?></div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
