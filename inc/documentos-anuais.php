<?php
/**
 * Editais e Resultados: publicações anuais administradas no WordPress.
 *
 * Não cria dados oficiais de exemplo: cada documento é cadastrado pela escola,
 * com ano, título, descrição e PDF opcional proveniente da Biblioteca de Mídia.
 */
if (!defined('ABSPATH')) exit;

function eeep_documento_tipos() {
    return array(
        'edital' => array(
            'singular' => 'Edital',
            'plural' => 'Editais',
            'descricao' => 'Editais e inscrições',
            'slug' => 'editais',
            'icon' => 'dashicons-media-document',
        ),
        'resultado' => array(
            'singular' => 'Resultado',
            'plural' => 'Resultados',
            'descricao' => 'Resultados de processos seletivos',
            'slug' => 'resultados',
            'icon' => 'dashicons-clipboard',
        ),
    );
}

function eeep_registrar_documentos_anuais() {
    foreach (eeep_documento_tipos() as $tipo => $config) {
        register_post_type($tipo, array(
            'labels' => array(
                'name' => $config['plural'],
                'singular_name' => $config['singular'],
                'menu_name' => $config['plural'],
                'all_items' => 'Todos os ' . $config['plural'],
                'add_new' => 'Adicionar novo',
                'add_new_item' => 'Adicionar ' . strtolower($config['singular']),
                'edit_item' => 'Editar ' . strtolower($config['singular']),
                'view_item' => 'Ver ' . strtolower($config['singular']),
                'not_found' => 'Nenhum documento encontrado',
            ),
            'public' => true,
            'has_archive' => $config['slug'],
            'rewrite' => array('slug' => $config['slug'], 'with_front' => false),
            'show_in_rest' => true,
            'show_in_menu' => true,
            'menu_icon' => $config['icon'],
            'supports' => array('title', 'editor', 'excerpt', 'revisions'),
        ));
        register_post_meta($tipo, 'eeep_documento_ano', array(
            'single' => true,
            'type' => 'integer',
            'show_in_rest' => true,
            'sanitize_callback' => 'absint',
            'auth_callback' => function () { return current_user_can('edit_posts'); },
        ));
        register_post_meta($tipo, 'eeep_documento_pdf', array(
            'single' => true,
            'type' => 'string',
            'show_in_rest' => true,
            'sanitize_callback' => 'esc_url_raw',
            'auth_callback' => function () { return current_user_can('edit_posts'); },
        ));
    }
}
add_action('init', 'eeep_registrar_documentos_anuais', 12);

function eeep_documento_metabox() {
    foreach (array_keys(eeep_documento_tipos()) as $tipo) {
        add_meta_box(
            'eeep_documento_pdf_box',
            'Ano e documento oficial',
            'eeep_documento_formulario',
            $tipo,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'eeep_documento_metabox');

function eeep_documento_formulario($post) {
    $ano = (int) get_post_meta($post->ID, 'eeep_documento_ano', true);
    $link = (string) get_post_meta($post->ID, 'eeep_documento_pdf', true);
    if ($ano < 2000) $ano = (int) wp_date('Y');

    wp_nonce_field('eeep_documento_salvar', 'eeep_documento_nonce');
    ?>
    <p>Preencha o ano do processo seletivo e selecione o PDF da instituição. Somente documentos <strong>publicados</strong> aparecem no site.</p>
    <p>
        <label for="eeep_documento_ano"><strong>Ano do processo seletivo</strong></label><br>
        <input type="number" id="eeep_documento_ano" name="eeep_documento_ano"
            value="<?php echo esc_attr($ano); ?>" min="2000" max="2100" step="1" required>
    </p>
    <p>
        <label for="eeep_documento_pdf"><strong>Link do PDF oficial</strong></label>
        <input type="url" id="eeep_documento_pdf" class="widefat" name="eeep_documento_pdf"
            value="<?php echo esc_attr($link); ?>" placeholder="https://site-da-escola/.../documento.pdf">
    </p>
    <p>
        <button type="button" class="button" data-eeep-selecionar-pdf>Selecionar PDF na Biblioteca de Mídia</button>
        <button type="button" class="button" data-eeep-limpar-pdf>Remover link</button>
    </p>
    <p><small>Para um edital ou resultado adicional do mesmo ano, crie uma nova publicação com outro título. Os documentos antigos não serão apagados.</small></p>
    <?php
}

function eeep_salvar_documento_anual($post_id, $post) {
    if (!$post || !in_array($post->post_type, array_keys(eeep_documento_tipos()), true)) return;
    if (!isset($_POST['eeep_documento_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['eeep_documento_nonce'])), 'eeep_documento_salvar')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $ano = isset($_POST['eeep_documento_ano']) ? absint(wp_unslash($_POST['eeep_documento_ano'])) : 0;
    if ($ano >= 2000 && $ano <= 2100) {
        update_post_meta($post_id, 'eeep_documento_ano', $ano);
    }
    $link = isset($_POST['eeep_documento_pdf']) && is_string($_POST['eeep_documento_pdf'])
        ? esc_url_raw(trim(wp_unslash($_POST['eeep_documento_pdf']))) : '';
    if ($link !== '') update_post_meta($post_id, 'eeep_documento_pdf', $link);
    else delete_post_meta($post_id, 'eeep_documento_pdf');
}
add_action('save_post', 'eeep_salvar_documento_anual', 10, 2);

function eeep_documentos_midia_admin($hook) {
    if (!in_array($hook, array('post.php', 'post-new.php'), true)) return;
    $tela = get_current_screen();
    if (!$tela || !in_array($tela->post_type, array_keys(eeep_documento_tipos()), true)) return;
    wp_enqueue_media();
    $path = get_template_directory() . '/assets/js/documentos-admin.js';
    wp_enqueue_script(
        'eeep-documentos-admin',
        get_template_directory_uri() . '/assets/js/documentos-admin.js',
        array('jquery'),
        file_exists($path) ? (string) filemtime($path) : wp_get_theme()->get('Version'),
        true
    );
}
add_action('admin_enqueue_scripts', 'eeep_documentos_midia_admin');

/** Os arquivos e o destaque inicial exibem o ano mais recente cadastrado. */
function eeep_documento_mais_recente($tipo) {
    if (!isset(eeep_documento_tipos()[$tipo])) return null;
    $docs = get_posts(array(
        'post_type' => $tipo,
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'meta_key' => 'eeep_documento_ano',
        'orderby' => array('meta_value_num' => 'DESC', 'date' => 'DESC'),
        'order' => 'DESC',
        'suppress_filters' => false,
    ));
    return !empty($docs) ? $docs[0] : null;
}

function eeep_documento_ano($post_id) {
    $ano = absint(get_post_meta($post_id, 'eeep_documento_ano', true));
    return ($ano >= 2000 && $ano <= 2100) ? $ano : (int) get_the_date('Y', $post_id);
}

function eeep_documentos_ordem_arquivo($query) {
    if (is_admin() || !$query->is_main_query() || !$query->is_post_type_archive(array('edital', 'resultado'))) return;
    $query->set('posts_per_page', 12);
    $query->set('meta_key', 'eeep_documento_ano');
    $query->set('orderby', array('meta_value_num' => 'DESC', 'date' => 'DESC'));
    $query->set('order', 'DESC');
    if (isset($_GET['ano'])) {
        $ano = absint(wp_unslash($_GET['ano']));
        if ($ano >= 2000 && $ano <= 2100) {
            $query->set('meta_query', array(
                array('key' => 'eeep_documento_ano', 'value' => $ano, 'compare' => '=', 'type' => 'NUMERIC')
            ));
        }
    }
}
add_action('pre_get_posts', 'eeep_documentos_ordem_arquivo');

/** Usada na lista pública, preservando os anos anteriores. */
function eeep_documentos_anos_disponiveis($tipo) {
    $ids = get_posts(array(
        'post_type' => $tipo, 'post_status' => 'publish',
        'numberposts' => -1, 'fields' => 'ids',
    ));
    $anos = array();
    foreach ($ids as $id) {
        $ano = eeep_documento_ano($id);
        if ($ano >= 2000 && $ano <= 2100) $anos[$ano] = $ano;
    }
    rsort($anos, SORT_NUMERIC);
    return $anos;
}

/** Atualizar permalinks uma vez na ativação do tema (não em cada visita). */
function eeep_documentos_ativar_tema() {
    eeep_registrar_documentos_anuais();
    flush_rewrite_rules(false);
}
add_action('after_switch_theme', 'eeep_documentos_ativar_tema');
