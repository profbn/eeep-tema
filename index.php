<?php
if (!defined('ABSPATH')) exit;
get_header();
?>
<section class="curso-detalhes">
    <div class="container">
        <h1 class="page-title"><?php echo is_home() ? 'Notícias e comunicados' : esc_html(get_the_archive_title()); ?></h1>
        <?php if (have_posts()) : ?>
            <div class="noticias-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="noticia-card">
                        <?php
                        $thumb = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium_large') : eeep_obter_imagem_post(get_the_ID());
                        if ($thumb) : ?>
                            <a href="<?php the_permalink(); ?>" class="noticia-img-link"><img src="<?php echo esc_url($thumb); ?>" alt="" loading="lazy" decoding="async"></a>
                        <?php endif; ?>
                        <div class="noticia-body">
                            <span class="noticia-data"><?php echo esc_html(get_the_date('d/m/Y')); ?></span>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo esc_html(get_the_excerpt()); ?></p>
                            <a href="<?php the_permalink(); ?>" class="noticia-ler-mais">Ler notícia →</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p>Nenhuma publicação encontrada.</p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
