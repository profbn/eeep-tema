<?php
if (!defined('ABSPATH')) exit;
get_header();

$categoria_atual = get_queried_object();
$filhas = array();
if ($categoria_atual instanceof WP_Term) {
    $filhas = get_categories(array(
        'taxonomy' => 'category',
        'parent' => $categoria_atual->term_id,
        'hide_empty' => false,
        'orderby' => 'name',
    ));
}
?>
<section class="curso-detalhes">
    <div class="container">
        <div class="category-lead">
            <span class="hero-badge">Conteúdos por assunto</span>
            <h1 class="page-title"><?php single_cat_title(); ?></h1>
            <?php if (category_description()) : ?>
                <div class="category-description"><?php echo wp_kses_post(category_description()); ?></div>
            <?php endif; ?>
        </div>
        <?php if ($filhas) : ?>
            <nav class="category-navigation" aria-label="Subcategorias">
                <?php foreach ($filhas as $filha) : ?>
                    <a href="<?php echo esc_url(get_category_link($filha->term_id)); ?>"><?php echo esc_html($filha->name); ?></a>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>

        <?php if (have_posts()) : ?>
            <div class="noticias-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="noticia-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="noticia-img-link">
                                <?php the_post_thumbnail('medium_large', array('loading' => 'lazy')); ?>
                            </a>
                        <?php endif; ?>
                        <div class="noticia-body">
                            <span class="noticia-data"><?php echo esc_html(get_the_date('d/m/Y')); ?></span>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                            <a href="<?php the_permalink(); ?>" class="noticia-ler-mais">Ler publicação ↗</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <div class="portal-widget"><p>Não há publicações nesta categoria ainda.</p></div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
