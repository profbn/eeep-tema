<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<article class="post-single-page">
    <header class="curso-hero">
        <div class="container">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="voltar-link">← Voltar à Página Inicial</a>
            <span class="curso-badge">Notícias & Comunicados</span>
            <h1><?php the_title(); ?></h1>
            <p class="curso-excerpt">Publicado em <?php echo get_the_date('d \d\e F \d\e Y'); ?></p>
        </div>
    </header>

    <section class="post-detalhes" style="padding: 50px 0;">
        <div class="container" style="max-width: 850px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.06);">
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-imagem-destaque" style="margin-bottom: 24px;">
                    <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; border-radius: 8px;')); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content" style="font-size: 1.1rem; line-height: 1.7; color: #333;">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </section>
</article>

<?php get_footer(); ?>
