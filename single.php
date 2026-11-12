<?php
if (!defined('ABSPATH')) exit;
get_header();
?>
<?php while (have_posts()) : the_post(); ?>
<article <?php post_class('post-single-page'); ?>>
    <header class="curso-hero">
        <div class="container">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="voltar-link">← Início</a>
            <span class="curso-badge">Notícias • Artigos • Comunicados</span>
            <h1><?php the_title(); ?></h1>
            <p class="curso-excerpt">Publicado em <?php echo esc_html(get_the_date('d/m/Y')); ?></p>
            <div class="post-category-tags" aria-label="Categorias desta publicação">
                <?php
                $categorias_post = get_the_category();
                foreach ($categorias_post as $categoria) :
                    if ((int) $categoria->term_id === (int) get_option('default_category')) continue;
                ?>
                    <a href="<?php echo esc_url(get_category_link($categoria->term_id)); ?>"><?php echo esc_html($categoria->name); ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </header>
    <section class="curso-detalhes">
        <div class="container post-layout">
            <div class="curso-main-content post-main-content">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-imagem-destaque">
                        <?php the_post_thumbnail('large', array('class' => 'post-image')); ?>
                    </div>
                <?php endif; ?>
                <div class="entry-content"><?php the_content(); ?></div>
                <?php wp_link_pages(); ?>
            </div>

            <aside class="post-sidebar" aria-label="Mais informações">
                <section class="portal-widget">
                    <h2>Explore por assunto</h2>
                    <nav aria-label="Categorias e subcategorias">
                        <ul>
                            <?php
                            wp_list_categories(array(
                                'title_li' => '',
                                'hierarchical' => true,
                                'hide_empty' => false,
                                'exclude' => array((int) get_option('default_category')),
                                'depth' => 0,
                            ));
                            ?>
                        </ul>
                    </nav>
                </section>
                <section class="portal-widget">
                    <h2>Publicações recentes</h2>
                    <ul>
                        <?php
                        $relacionados = new WP_Query(array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => 5,
                            'post__not_in' => array(get_the_ID()),
                            'ignore_sticky_posts' => true,
                        ));
                        while ($relacionados->have_posts()) : $relacionados->the_post();
                        ?>
                            <li><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </section>
                <section class="portal-widget portal-widget--accent">
                    <h2>Conheça os cursos técnicos</h2>
                    <p>Formação profissional e oportunidades de aprendizagem para os estudantes.</p>
                    <a href="<?php echo esc_url(home_url('/#cursos')); ?>">Ver os cursos ↗</a>
                </section>
            </aside>
        </div>
    </section>
</article>
<?php endwhile; ?>
<?php get_footer(); ?>
