<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<?php while (have_posts()) : the_post(); ?>
<article <?php post_class('post-single-page'); ?>>
    <header class="curso-hero">
        <div class="container">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="voltar-link">← Voltar à página inicial</a>
            <span class="curso-badge">Notícias e comunicados</span>
            <h1><?php the_title(); ?></h1>
            <p class="curso-excerpt">Publicado em <?php echo esc_html(get_the_date('d/m/Y')); ?></p>
        </div>
    </header>
    <section class="curso-detalhes">
        <div class="container">
            <div class="curso-main-content post-main-content">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-imagem-destaque">
                        <?php the_post_thumbnail('large', array('class' => 'post-image')); ?>
                    </div>
                <?php endif; ?>
                <div class="entry-content"><?php the_content(); ?></div>
                <?php wp_link_pages(); ?>
            </div>
        </div>
    </section>
</article>
<?php endwhile; ?>

<?php get_footer(); ?>
