<?php
if (!defined('ABSPATH')) exit;
get_header();
?>
<section class="curso-hero">
    <div class="container">
        <h1>Todos os cursos técnicos</h1>
        <p>Conheça a formação técnica oferecida pela nossa escola.</p>
    </div>
</section>
<section class="home-cursos">
    <div class="container cursos-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="curso-card-link">
                    <article class="curso-card">
                        <span class="curso-tag">Curso técnico</span>
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo esc_html(get_the_excerpt()); ?></p>
                        <span class="curso-saiba-mais">Ver detalhes do curso →</span>
                    </article>
                </a>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Nenhum curso publicado.</p>
        <?php endif; ?>
    </div>
    <div class="container"><?php the_posts_pagination(); ?></div>
</section>
<?php get_footer(); ?>
