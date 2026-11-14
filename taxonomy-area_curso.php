<?php
/**
 * Arquivo de conteúdos associados a cada um dos cinco cursos técnicos.
 */
if (!defined('ABSPATH')) exit;
get_header();
$curso_atual = get_queried_object();
?>
<section class="eeep-institutional-page eeep-content-areas">
    <div class="container">
        <div class="eeep-page-intro">
            <a class="eeep-back-link" href="<?php echo esc_url(home_url('/conteudos-interativos/')); ?>">← Todos os cursos</a>
            <span class="eeep-section-eyebrow">Materiais e atividades</span>
            <h1><?php echo esc_html($curso_atual instanceof WP_Term ? $curso_atual->name : 'Conteúdos interativos'); ?></h1>
            <p>Materiais associados a este curso. Selecione a publicação para acessar o conteúdo.</p>
        </div>
        <?php if (have_posts()) : ?>
            <div class="noticias-grid">
                <?php while (have_posts()) : the_post();
                    $imagem = has_post_thumbnail()
                        ? get_the_post_thumbnail_url(get_the_ID(), 'medium_large')
                        : eeep_obter_imagem_post(get_the_ID());
                ?>
                    <article class="noticia-card">
                        <?php if ($imagem) : ?>
                            <a class="noticia-img-link" href="<?php the_permalink(); ?>">
                                <img loading="lazy" decoding="async" src="<?php echo esc_url($imagem); ?>" alt="">
                            </a>
                        <?php endif; ?>
                        <div class="noticia-body">
                            <span class="noticia-data"><?php echo esc_html(get_the_date('d/m/Y')); ?></span>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                            <a class="noticia-ler-mais" href="<?php the_permalink(); ?>">Abrir conteúdo ↗</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <div class="eeep-empty-state">
                <h2>Conteúdos em preparação</h2>
                <p>Nenhum material foi publicado para este curso até o momento.</p>
                <a class="btn btn-primary" href="<?php echo esc_url(home_url('/conteudos-interativos/')); ?>">Explorar os outros cursos</a>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
