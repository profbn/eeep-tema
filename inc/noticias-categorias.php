<?php
/**
 * Grade editorial de notícias da página inicial.
 * Quatro posições de categoria selecionáveis em Aparência → Personalizar.
 */
if (!defined('ABSPATH')) exit;

/**
 * Permite que o administrador selecione uma categoria WordPress por cartão.
 * "Mais recentes" usa o próximo post publicado ainda não exibido na grade.
 */
function eeep_personalizar_grade_noticias($wp_customize) {
    $wp_customize->add_section('eeep_grade_noticias', array(
        'title'       => 'Notícias por categoria',
        'description' => 'Escolha a categoria de cada um dos quatro cartões exibidos abaixo do Portal de notícias e informações. O cartão mostra a publicação mais recente da categoria. Deixe "Mais recentes" para preencher com posts recentes. Crie categorias em Posts → Categorias.',
        'priority'    => 42,
    ));

    $opcoes = array(0 => 'Mais recentes (sem filtro)');
    $categorias = get_categories(array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC',
    ));

    if (!is_wp_error($categorias)) {
        foreach ($categorias as $categoria) {
            $nivel = count(get_ancestors($categoria->term_id, 'category', 'taxonomy'));
            $opcoes[$categoria->term_id] = str_repeat('— ', min($nivel, 6)) . $categoria->name;
        }
    }

    for ($posicao = 1; $posicao <= 4; $posicao++) {
        $id = 'eeep_grade_categoria_' . $posicao;

        $wp_customize->add_setting($id, array(
            'default' => 0,
            'type' => 'theme_mod',
            'sanitize_callback' => 'absint',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control($id, array(
            'type' => 'select',
            'section' => 'eeep_grade_noticias',
            'label' => 'Cartão ' . $posicao . ' — Categoria',
            'description' => 'Exibe a publicação mais recente desta categoria, sem repetir matérias de outros cartões.',
            'choices' => $opcoes,
        ));
    }
}
add_action('customize_register', 'eeep_personalizar_grade_noticias');

/**
 * Retorna um post por posição, evitando repetições quando posts possuem
 * várias categorias ou quando posições usam a mesma categoria.
 * Categorias configuradas sem posts ficam sem cartão (não exibem outro assunto).
 */
function eeep_obter_grade_noticias() {
    $posts = array();
    $ids_usados = array();

    for ($posicao = 1; $posicao <= 4; $posicao++) {
        $id_categoria = absint(get_theme_mod('eeep_grade_categoria_' . $posicao, 0));
        $categoria = $id_categoria ? get_category($id_categoria) : null;

        if ($id_categoria && (!$categoria || is_wp_error($categoria))) {
            continue;
        }

        $consulta = new WP_Query(array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'ignore_sticky_posts' => true,
            'no_found_rows' => true,
            'post__not_in' => $ids_usados,
            'orderby' => 'date',
            'order' => 'DESC',
            'category__in' => $id_categoria ? array($id_categoria) : array(),
        ));

        if (!$consulta->have_posts()) {
            wp_reset_postdata();
            continue;
        }

        $post = $consulta->posts[0];
        $ids_usados[] = $post->ID;

        if (!$categoria) {
            $categorias_post = get_the_category($post->ID);
            $categoria = !empty($categorias_post) ? $categorias_post[0] : null;
        }

        $posts[] = array(
            'post' => $post,
            'category' => $categoria,
            'slot' => $posicao,
        );
        wp_reset_postdata();
    }

    return $posts;
}
