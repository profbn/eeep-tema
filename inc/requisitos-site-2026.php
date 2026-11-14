<?php
/**
 * Complementos do portal EEEP de acordo com a especificação institucional 2026.
 * Informações históricas, curriculares e editais devem ser conferidos pela escola.
 */
if (!defined('ABSPATH')) exit;

/**
 * As publicações já usam "category" (categorias gerais). Esta taxonomia
 * indica a qual curso pertence uma atividade interativa.
 */
function eeep_registrar_areas_curso() {
    register_taxonomy('area_curso', array('post'), array(
        'labels' => array(
            'name' => 'Cursos relacionados',
            'singular_name' => 'Curso relacionado',
            'menu_name' => 'Curso relacionado',
            'all_items' => 'Todas as áreas',
            'edit_item' => 'Editar área',
            'add_new_item' => 'Adicionar área',
            'search_items' => 'Buscar cursos',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'conteudos/curso', 'with_front' => false),
    ));
}
add_action('init', 'eeep_registrar_areas_curso', 12);

function eeep_cursos_requeridos() {
    return array(
        'administracao' => 'Administração',
        'edificacoes' => 'Edificações',
        'eletromecanica' => 'Eletromecânica',
        'logistica' => 'Logística',
        'informatica' => 'Informática',
    );
}

/**
 * Criar somente os cinco termos necessários. Não apagar nem alterar posts.
 * Criar páginas institucionais de modo idempotente, sem fingir que textos
 * históricos ou atividades já foram oficialmente validados.
 */
function eeep_inicializar_requisitos_site() {
    if (!current_user_can('manage_options')) return;

    foreach (eeep_cursos_requeridos() as $slug => $nome) {
        if (!term_exists($slug, 'area_curso')) {
            wp_insert_term($nome, 'area_curso', array('slug' => $slug));
        }
    }

    $paginas = array(
        'sobre-a-escola' => array(
            'title' => 'Sobre a escola',
            'content' =>
                '<!-- wp:paragraph --><p>Conheça a trajetória de nossa escola. As informações desta página serão complementadas após conferência institucional.</p><!-- /wp:paragraph -->' .
                '<!-- wp:heading --><h2>História da instituição</h2><!-- /wp:heading -->' .
                '<!-- wp:paragraph --><p>Informações históricas aguardando validação da escola.</p><!-- /wp:paragraph -->' .
                '<!-- wp:heading --><h2>Origem do nome</h2><!-- /wp:heading -->' .
                '<!-- wp:paragraph --><p>Informações sobre a pessoa homenageada aguardando validação da escola.</p><!-- /wp:paragraph -->',
        ),
        'conteudos-interativos' => array(
            'title' => 'Conteúdos interativos',
            'content' =>
                '<!-- wp:paragraph --><p>Explore os materiais e atividades publicados para cada curso técnico. As publicações são organizadas por curso relacionado.</p><!-- /wp:paragraph -->',
        ),
    );
    foreach ($paginas as $slug => $info) {
        if (!get_page_by_path($slug, OBJECT, 'page')) {
            wp_insert_post(array(
                'post_type' => 'page',
                'post_status' => 'publish',
                'post_title' => $info['title'],
                'post_name' => $slug,
                'post_content' => $info['content'],
            ));
        }
    }
    if (!get_option('eeep_requisitos_2026_inicializados')) {
        update_option('eeep_requisitos_2026_inicializados', '1', false);
        flush_rewrite_rules(false);
    }
}
add_action('admin_init', 'eeep_inicializar_requisitos_site');

/** Campos editáveis do curso: preenchimento somente com documentos oficiais. */
function eeep_registrar_metabox_curso() {
    add_meta_box(
        'eeep_grade_curricular',
        'Informações oficiais e grade curricular',
        'eeep_renderizar_metabox_curso',
        'curso',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'eeep_registrar_metabox_curso');

function eeep_campos_curso() {
    return array(
        'eeep_curso_objetivo' => array('label' => 'Objetivos do curso (resumo)', 'type' => 'textarea'),
        'eeep_curso_areas' => array('label' => 'Conhecimentos e áreas abordadas', 'type' => 'textarea'),
        'eeep_curso_duracao' => array('label' => 'Duração oficial', 'type' => 'text'),
        'eeep_curso_carga_horaria' => array('label' => 'Carga horária oficial', 'type' => 'text'),
        'eeep_curso_modalidade' => array('label' => 'Modalidade', 'type' => 'text'),
        'eeep_grade_ano_1' => array('label' => 'Grade curricular — 1º ano (uma disciplina por linha)', 'type' => 'textarea'),
        'eeep_grade_ano_2' => array('label' => 'Grade curricular — 2º ano (uma disciplina por linha)', 'type' => 'textarea'),
        'eeep_grade_ano_3' => array('label' => 'Grade curricular — 3º ano (uma disciplina por linha)', 'type' => 'textarea'),
        'eeep_grade_pdf' => array('label' => 'Link do PDF da grade curricular oficial (opcional)', 'type' => 'url'),
        'eeep_edital_url' => array('label' => 'Link do edital oficial aplicável (opcional)', 'type' => 'url'),
    );
}

function eeep_renderizar_metabox_curso($post) {
    wp_nonce_field('eeep_salvar_informacoes_curso', 'eeep_curso_nonce');
    echo '<p>Preencha com informações <strong>confirmadas pela escola</strong>. Campos em branco não mostram valores presumidos.</p>';
    foreach (eeep_campos_curso() as $key => $field) {
        $value = (string) get_post_meta($post->ID, $key, true);
        echo '<p><label for="' . esc_attr($key) . '"><strong>' . esc_html($field['label']) . '</strong></label></p>';
        if ($field['type'] === 'textarea') {
            echo '<p><textarea id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" rows="5" class="widefat">' . esc_textarea($value) . '</textarea></p>';
        } else {
            echo '<p><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" class="widefat" type="' . esc_attr($field['type']) . '" value="' . esc_attr($value) . '"></p>';
        }
    }
}

function eeep_salvar_campos_curso($post_id) {
    if (!isset($_POST['eeep_curso_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['eeep_curso_nonce'])), 'eeep_salvar_informacoes_curso')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;
    if (!current_user_can('edit_post', $post_id)) return;
    foreach (eeep_campos_curso() as $key => $field) {
        if (!isset($_POST[$key])) continue;
        $raw = wp_unslash($_POST[$key]);
        if (!is_string($raw)) continue;
        $value = $field['type'] === 'url' ? esc_url_raw(trim($raw)) :
            ($field['type'] === 'textarea' ? sanitize_textarea_field($raw) : sanitize_text_field($raw));
        if ($value === '') delete_post_meta($post_id, $key);
        else update_post_meta($post_id, $key, $value);
    }
}
add_action('save_post_curso', 'eeep_salvar_campos_curso');

function eeep_lista_grade($texto) {
    $disciplinas = array_filter(array_map('trim', preg_split('/\r\n|\n|\r/', (string) $texto)));
    if (!$disciplinas) return '';
    $out = '<ul class="eeep-grade-lista">';
    foreach ($disciplinas as $disciplina) {
        $out .= '<li>' . esc_html($disciplina) . '</li>';
    }
    return $out . '</ul>';
}

function eeep_link_area_curso($slug) {
    $term = get_term_by('slug', $slug, 'area_curso');
    if (!$term || is_wp_error($term)) return home_url('/conteudos-interativos/');
    $link = get_term_link($term);
    return is_wp_error($link) ? home_url('/conteudos-interativos/') : $link;
}
