<?php
if (!defined('ABSPATH')) exit;

// Organização modular das melhorias institucionais de 2026.
require_once get_template_directory() . '/inc/requisitos-site-2026.php';
require_once get_template_directory() . '/inc/documentos-anuais.php';

// Recursos do tema: sem CSS duplicado e sem cache desativado a cada acesso.
function eeep_carregar_recursos() {
    $versao = wp_get_theme()->get('Version');
    wp_enqueue_style('eeep-style', get_stylesheet_uri(), array(), $versao);
    wp_enqueue_style('eeep-portal-2026', get_template_directory_uri() . '/assets/css/portal-2026.css', array('eeep-style'), $versao);
    wp_enqueue_style('eeep-requisitos-2026', get_template_directory_uri() . '/assets/css/requisitos-2026.css', array('eeep-portal-2026'), $versao);
    wp_enqueue_style('eeep-documentos-anuais', get_template_directory_uri() . '/assets/css/documentos-anuais.css', array('eeep-requisitos-2026'), $versao);
    wp_enqueue_style('eeep-noticias-2026', get_template_directory_uri() . '/assets/css/noticias-2026.css', array('eeep-documentos-anuais'), $versao);
    $slider_js = get_template_directory() . '/assets/js/portal-slider.js';
    $slider_versao = file_exists($slider_js) ? (string) filemtime($slider_js) : $versao;
    wp_enqueue_script('eeep-portal-slider', get_template_directory_uri() . '/assets/js/portal-slider.js', array(), $slider_versao, true);
    wp_enqueue_script(
        'eeep-acessibilidade',
        get_template_directory_uri() . '/acessibilidade.js',
        array(),
        $versao,
        true
    );

    // O componente de Libras é opcional e não deve interromper o menu se estiver indisponível.
    wp_enqueue_script('eeep-vlibras', 'https://vlibras.gov.br/app/vlibras-plugin.js', array(), null, true);
    wp_add_inline_script(
        'eeep-vlibras',
        "if (window.VLibras && window.VLibras.Widget) { new window.VLibras.Widget('https://vlibras.gov.br/app'); }"
    );
}
add_action('wp_enqueue_scripts', 'eeep_carregar_recursos');

// Permitir administrar o menu e o logo diretamente pelo WordPress.
function eeep_configuracoes_tema() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 80,
        'width' => 280,
        'flex-width' => true,
        'flex-height' => true,
    ));
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    register_nav_menus(array(
        'primary' => 'Menu principal (cabeçalho)',
        'categories' => 'Categorias e subcategorias (opcional)',
    ));
}
add_action('after_setup_theme', 'eeep_configuracoes_tema');

// Links úteis até que um administrador configure Aparência > Menus.
// Ao atribuir um menu à localização "Menu principal", o WordPress o substitui.
function eeep_menu_padrao($args = array()) {
    $base = home_url('/');
    ?>
    <ul id="primary-menu" class="nav-menu">
        <li><a href="<?php echo esc_url($base); ?>">Início</a></li>
        <li><a href="<?php echo esc_url($base . '#cursos'); ?>">Cursos</a></li>
        <li><a href="<?php echo esc_url(home_url('/conteudos-interativos/')); ?>">Conteúdos interativos</a></li>
        <li><a href="<?php echo esc_url(home_url('/sobre-a-escola/')); ?>">Sobre a escola</a></li>
        <li><a href="<?php echo esc_url(get_post_type_archive_link('edital')); ?>">Editais</a></li>
        <li><a href="<?php echo esc_url(get_post_type_archive_link('resultado')); ?>">Resultados</a></li>
        <li><a class="nav-btn-yt" href="https://www.youtube.com/@EEEPPROFANTONIOVALMIR" target="_blank" rel="noopener noreferrer">YouTube</a></li>
        <?php echo eeep_html_categorias_menu(); ?>
    </ul>
    <?php
}

/**
 * Obter a primeira imagem da publicação para o destaque.
 * A imagem destacada tem precedência no modelo.
 */
function eeep_obter_imagem_post($post_id) {
    $conteudo = (string) get_post_field('post_content', (int) $post_id);
    if (preg_match('/wp-image-([0-9]+)/i', $conteudo, $match)) {
        $imagem = wp_get_attachment_image_url((int) $match[1], 'large');
        if ($imagem) return $imagem;
    }
    if (preg_match('/"id"\s*:\s*([0-9]+)/', $conteudo, $match) && strpos($conteudo, 'wp:image') !== false) {
        $imagem = wp_get_attachment_image_url((int) $match[1], 'large');
        if ($imagem) return $imagem;
    }
    // URL direta, iframe embed ou link simples para YouTube.
    $yt_pattern = '~(?:youtube\.com/(?:watch\?(?:[^"\s<>]*&)?v=|embed/|shorts/|live/)|youtu\.be/)([a-zA-Z0-9_-]{11})~';
    if (preg_match($yt_pattern, html_entity_decode($conteudo, ENT_QUOTES, 'UTF-8'), $match)) {
        return 'https://i.ytimg.com/vi/' . $match[1] . '/hqdefault.jpg';
    }
    if (preg_match('~<img[^>]+src=["\'](https?://[^"\']+)["\']~i', $conteudo, $match)) {
        return esc_url_raw(html_entity_decode($match[1], ENT_QUOTES, 'UTF-8'));
    }
    return '';
}

/**
 * Menu automático de categorias e subcategorias. Não depende do menu salvo.
 * Apenas categorias criadas pelo administrador são exibidas (exceto a
 * categoria padrão "Sem categoria").
 */
function eeep_html_categorias_menu() {
    $padrao = (int) get_option('default_category');
    if (has_nav_menu('categories')) {
        // Menu opcional: o administrador controla a ordem e as subcategorias.
        $itens = wp_nav_menu(array(
            'theme_location' => 'categories',
            'container' => false,
            'echo' => false,
            'items_wrap' => '%3$s',
            'depth' => 4,
        ));
    } else {
        // Sem menu opcional, lista automaticamente as categorias do WordPress.
        $categorias = get_categories(array('hide_empty' => false, 'exclude' => array($padrao)));
        if (is_wp_error($categorias) || empty($categorias)) {
            return '';
        }
        $itens = wp_list_categories(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'hierarchical' => true,
            'depth' => 0,
            'exclude' => array($padrao),
            'title_li' => '',
            'echo' => false,
            'orderby' => 'name',
        ));
        $itens = str_replace('class="children"', 'class="sub-menu"', $itens);
    }

    if (!is_string($itens) || trim($itens) === '') {
        return '';
    }
    $pagina_blog = (int) get_option('page_for_posts');
    $url = $pagina_blog ? get_permalink($pagina_blog) : home_url('/');
    return '<li class="menu-item menu-item-has-children eeep-categories-menu">' .
        '<a href="' . esc_url($url) . '">Categorias</a>' .
        '<ul class="sub-menu">' . $itens . '</ul></li>';
}

function eeep_adicionar_categorias_menu($items, $args) {
    if (isset($args->theme_location) && $args->theme_location === 'primary') {
        $items .= eeep_html_categorias_menu();
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'eeep_adicionar_categorias_menu', 10, 2);

// O WordPress já registra "category" para Posts. Reafirmar a associação
// torna explícito que artigos continuam categorizáveis com o tema ativo.
add_action('init', function () {
    register_taxonomy_for_object_type('category', 'post');
}, 20);

// Registrar Custom Post Type: Cursos Técnicos
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

// Criar automaticamente os 5 Cursos Técnicos no Banco de Dados
function eeep_autocriar_cursos() {
    if (get_option('eeep_cursos_populados_v1')) {
        return;
    }

    $cursos = array(
        'administracao' => array(
            'post_title'   => 'Técnico em Administração',
            'post_excerpt' => 'Gestão empresarial, recursos humanos, finanças e logística organizacional.',
            'post_content' => '<h2>Apresentação do Curso</h2><p>O Curso Técnico em Administração da <strong>EEEP Professor Antonio Valmir da Silva</strong> forma profissionais aptos a atuar no planejamento, execução e controle dos processos administrativos de empresas públicas, privadas e do terceiro setor.</p><h2>Perfil Profissional de Conclusão</h2><p>O egresso do curso estará preparado para:</p><ul><li>Elaborar e analisar relatórios financeiros, orçamentos e planilhas de controle.</li><li>Gerenciar rotinas de Recursos Humanos, departamento pessoal e recrutamento.</li><li>Aplicar estratégias de Marketing, atendimento ao cliente e vendas.</li><li>Identificar oportunidades de negócios e desenvolver planos empreendedores.</li></ul><h2>Estrutura Curricular (Módulos)</h2><ul><li><strong>Módulo I — Fundamentos de Gestão:</strong> Teoria Geral da Administração, Economia, Matemática Financeira e Comunicação Empresarial.</li><li><strong>Módulo II — Operações Financeiras e Pessoas:</strong> Gestão Financeira, Contabilidade, Gestão de Pessoas e Legislação Trabalhista.</li><li><strong>Módulo III — Estratégia e Empreendedorismo:</strong> Marketing Digital, Gestão de Operações, Logística Empresarial e Plano de Negócios.</li></ul><h2>Campo de Atuação</h2><p>Empresas comerciais e industriais, órgãos públicos, instituições financeiras, escritórios de contabilidade e consultoria.</p>',
        ),
        'edificacoes' => array(
            'post_title'   => 'Técnico em Edificações',
            'post_excerpt' => 'Desenho técnico, projetos arquitetônicos, medições e acompanhamento de obras.',
            'post_content' => '<h2>Apresentação do Curso</h2><p>O Curso Técnico em Edificações prepara o estudante para participar diretamente no desenvolvimento, planejamento e execução de obras de engenharia civil e arquitetura, seguindo normas técnicas e de segurança.</p><h2>Perfil Profissional de Conclusão</h2><p>O egresso do curso estará preparado para:</p><ul><li>Desenhar e interpretar projetos arquitetônicos, estruturais e de instalações prediais.</li><li>Utilizar softwares de modelagem técnica e desenho (CAD e sistemas BIM).</li><li>Supervisionar canteiros de obras, controlando prazos, qualidade e materiais.</li><li>Realizar orçamentos, medições de obras e ensaios de laboratório de solos e concreto.</li></ul><h2>Estrutura Curricular (Módulos)</h2><ul><li><strong>Módulo I — Desenho e Topografia:</strong> Desenho Técnico, Topografia, Geometria Descritiva e Segurança do Trabalho.</li><li><strong>Módulo II — Materiais e Projetos:</strong> Materiais de Construção, Projetos Arquitetônicos, Instalações Elétricas e Hidrossanitárias.</li><li><strong>Módulo III — Gestão de Obras:</strong> Mecânica dos Solos, Planejamento e Orçamento de Obras e Patologia das Construções.</li></ul><h2>Campo de Atuação</h2><p>Construtoras, incorporadoras, escritórios de arquitetura e engenharia, empresas de reforma e órgãos públicos de fiscalização.</p>',
        ),
        'eletromecanica' => array(
            'post_title'   => 'Técnico em Eletromecânica',
            'post_excerpt' => 'Manutenção industrial, automação, circuitos elétricos e sistemas mecânicos.',
            'post_content' => '<h2>Apresentação do Curso</h2><p>O Curso Técnico em Eletromecânica combina disciplinas de eletricidade, mecânica e automação, formando profissionais polivalentes para operar e manter máquinas industriais modernas.</p><h2>Perfil Profissional de Conclusão</h2><p>O egresso do curso estará preparado para:</p><ul><li>Montar, instalar e realizar manutenção preventiva e corretiva em máquinas eletromecânicas.</li><li>Interpretar esquemas elétricos industriais e desenhos mecânicos.</li><li>Programar e operar controladores lógicos programáveis (CLP) e sistemas automatizados.</li><li>Executar medições elétricas e mecânicas com instrumentos de precisão.</li></ul><h2>Estrutura Curricular (Módulos)</h2><ul><li><strong>Módulo I — Fundamentos Tecnológicos:</strong> Eletricidade Básica, Desenho Técnico Mecânico e Metrologia.</li><li><strong>Módulo II — Comandos e Mecânica:</strong> Comandos Elétricos, Elementos de Máquinas e Usinagem.</li><li><strong>Módulo III — Automação e Manutenção:</strong> Automação Industrial, Manutenção Eletromecânica e Termodinâmica.</li></ul><h2>Campo de Atuação</h2><p>Indústrias automobilísticas, alimentícias, têxteis, usinas de energia, empresas de manutenção e montagem industrial.</p>',
        ),
        'logistica' => array(
            'post_title'   => 'Técnico em Logística',
            'post_excerpt' => 'Gestão de estoque, cadeia de suprimentos, transporte e distribuição.',
            'post_content' => '<h2>Apresentação do Curso</h2><p>O Curso Técnico em Logística visa capacitar estudantes para otimizar os fluxos de materiais, informações e recursos desde a origem dos insumos até a entrega do produto ao consumidor final.</p><h2>Perfil Profissional de Conclusão</h2><p>O egresso do curso estará preparado para:</p><ul><li>Planear e controlar o armazenamento, movimentação e inventário de estoques.</li><li>Dimensionar e gerenciar frotas de transporte e rotas de distribuição.</li><li>Operar sistemas de gestão logística (WMS, ERP e rastreamento de cargas).</li><li>Coordenar operações de compra, embalagem e logística reversa.</li></ul><h2>Estrutura Curricular (Módulos)</h2><ul><li><strong>Módulo I — Fundamentos Logísticos:</strong> Introdução à Logística, Gestão de Armazenagem e Embalagens.</li><li><strong>Módulo II — Transportes e Estoques:</strong> Gestão de Estoques, Modalidades de Transporte e Custos Logísticos.</li><li><strong>Módulo III — Supply Chain:</strong> Cadeia de Suprimentos (Supply Chain), Logística Internacional e Indicadores de Desempenho.</li></ul><h2>Campo de Atuação</h2><p>Centros de distribuição (CDs), transportadoras, operadores logísticos, indústrias, e-commerce, portos e aeroportos.</p>',
        ),
        'informatica' => array(
            'post_title'   => 'Técnico em Informática',
            'post_excerpt' => 'Desenvolvimento de software, redes de computadores, banco de dados e sistemas.',
            'post_content' => '<h2>Apresentação do Curso</h2><p>O Curso Técnico em Informática prepara o estudante para desenvolver sistemas de software, estruturar redes locais de computadores, gerenciar bancos de dados e fornecer suporte técnico em tecnologia da informação.</p><h2>Perfil Profissional de Conclusão</h2><p>O egresso do curso estará preparado para:</p><ul><li>Desenvolver aplicações Web e Mobile utilizando linguagens modernas de programação.</li><li>Modelar, implementar e administrar bancos de dados relacionais.</li><li>Configurar e gerenciar redes de computadores, roteadores e servidores.</li><li>Montar, diagnosticar e realizar manutenção em hardware e sistemas operacionais.</li></ul><h2>Estrutura Curricular (Módulos)</h2><ul><li><strong>Módulo I — Algoritmos e Hardware:</strong> Lógica de Programação, Arquitetura de Computadores e Redes.</li><li><strong>Módulo II — Desenvolvimento e Banco de Dados:</strong> Desenvolvimento Web (HTML/CSS/JS) e Banco de Dados SQL.</li><li><strong>Módulo III — Programação Avançada e Projetos:</strong> Desenvolvimento de APIs, Aplicações Mobile e Segurança da Informação.</li></ul><h2>Campo de Atuação</h2><p>Empresas de desenvolvimento de software, startups, departamentos de TI corporativos, provedores de internet e autônomo.</p>',
        ),
    );

    foreach ($cursos as $slug => $dados) {
        $post_existente = get_page_by_path($slug, OBJECT, 'curso');
        if (!$post_existente) {
            wp_insert_post(array(
                'post_title'   => $dados['post_title'],
                'post_name'    => $slug,
                'post_content' => '<p>Apresentação do curso em preparação. As informações oficiais serão disponibilizadas após conferência pela escola.</p>',
                'post_excerpt' => $dados['post_excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'curso',
            ));
        }
    }

    flush_rewrite_rules();
    update_option('eeep_cursos_populados_v1', true);
}
add_action('init', 'eeep_autocriar_cursos', 20);
