<?php
if (!defined('ABSPATH')) exit;

// Carregar CSS e Scripts no WordPress
function eeep_carregar_recursos() {
    wp_enqueue_style('eeep-style', get_stylesheet_uri(), array(), time());
}
add_action('wp_enqueue_scripts', 'eeep_carregar_recursos');

// Suportes do Tema
function eeep_configuracoes_tema() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'eeep_configuracoes_tema');

// Registar CPT Curso caso necessário
function eeep_registrar_cpt_curso() {
    $labels = array(
        'name'               => 'Cursos',
        'singular_name'      => 'Curso',
        'menu_name'          => 'Cursos Técnicos',
        'add_new'            => 'Adicionar Novo',
        'add_new_item'       => 'Adicionar Novo Curso',
        'edit_item'          => 'Editar Curso',
        'new_item'           => 'Novo Curso',
        'view_item'          => 'Ver Curso',
        'search_items'       => 'Procurar Cursos',
        'not_found'          => 'Nenhum curso encontrado',
        'not_found_in_trash' => 'Nenhum curso na lixeira'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-welcome-learn-more',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'            => array('slug' => 'curso', 'with_front' => false),
    );

    register_post_type('curso', $args);
}
add_action('init', 'eeep_registrar_cpt_curso');
