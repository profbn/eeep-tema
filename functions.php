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
                'post_content' => $dados['post_content'],
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
