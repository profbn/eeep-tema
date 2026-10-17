<?php
/**
 * Template Name: Mapa do Site Acessível
 * Description: Estrutura semântica e organizada para navegação rápida e leitores de tela.
 */

if (!defined('ABSPATH')) exit;

get_header();
?>

<article class="mapa-site-container">
    <header class="mapa-header">
        <h1><?php the_title(); ?></h1>
        <p>Utilize os links abaixo para navegar diretamente pelas seções e conteúdos do portal da EEEP.</p>
    </header>

    <!-- Campo de Pesquisa Direta -->
    <section class="mapa-secao" aria-labelledby="titulo-busca">
        <h2 id="titulo-busca">Pesquisa Rápida</h2>
        <?php get_search_form(); ?>
    </section>

    <div class="mapa-grid">
        <!-- 1. Páginas Institucionais -->
        <section class="mapa-secao" aria-labelledby="titulo-paginas">
            <h2 id="titulo-paginas">Páginas do Portal</h2>
            <nav aria-label="Mapa do Site - Páginas Institucionais">
                <ul class="mapa-lista">
                    <?php
                    wp_list_pages(array(
                        'title_li'    => '',
                        'post_type'   => 'page',
                        'post_status' => 'publish'
                    ));
                    ?>
                </ul>
            </nav>
        </section>

        <!-- 2. Categorias de Notícias e Eventos -->
        <section class="mapa-secao" aria-labelledby="titulo-categorias">
            <h2 id="titulo-categorias">Categorias de Conteúdo</h2>
            <nav aria-label="Mapa do Site - Categorias">
                <ul class="mapa-lista">
                    <?php
                    wp_list_categories(array(
                        'title_li'   => '',
                        'show_count' => true
                    ));
                    ?>
                </ul>
            </nav>
        </section>

        <!-- 3. Publicações e Comunicados Recentes -->
        <section class="mapa-secao" aria-labelledby="titulo-posts">
            <h2 id="titulo-posts">Publicações Recentes</h2>
            <nav aria-label="Mapa do Site - Notícias Recentes">
                <ul class="mapa-lista">
                    <?php
                    $recent_posts = get_posts(array(
                        'numberposts' => 10,
                        'post_status' => 'publish'
                    ));
                    foreach ($recent_posts as $post) :
                        setup_postdata($post);
                    ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <small style="display:block; color:#666; font-size:0.8rem;"><?php echo get_the_date(); ?></small>
                        </li>
                    <?php
                    endforeach;
                    wp_reset_postdata();
                    ?>
                </ul>
            </nav>
        </section>
    </div>
</article>

<?php get_footer(); ?>
