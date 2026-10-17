<?php
if (!defined('ABSPATH')) exit;
get_header();

$cursos_padrao = [
    'administracao' => [
        'titulo'  => 'Técnico em Administração',
        'resumo'  => 'Capacitação em planejamento, rotinas financeiras, recursos humanos, marketing e gestão organizacional.',
        'conteudo' => '<h2>Apresentação do Curso</h2><p>O Curso Técnico em Administração da <strong>EEEP Professor Antonio Valmir da Silva</strong> forma profissionais aptos a atuar no planejamento, execução e controle dos processos administrativos de empresas públicas, privadas e do terceiro setor.</p><h2>Perfil Profissional de Conclusão</h2><p>O egresso do curso estará preparado para:</p><ul><li>Elaborar e analisar relatórios financeiros, orçamentos e planilhas de controle.</li><li>Gerenciar rotinas de Recursos Humanos, departamento pessoal e recrutamento.</li><li>Aplicar estratégias de Marketing, atendimento ao cliente e vendas.</li><li>Identificar oportunidades de negócios e desenvolver planos empreendedores.</li></ul><h2>Estrutura Curricular (Módulos)</h2><ul><li><strong>Módulo I — Fundamentos de Gestão:</strong> Teoria Geral da Administração, Economia, Matemática Financeira e Comunicação Empresarial.</li><li><strong>Módulo II — Operações Financeiras e Pessoas:</strong> Gestão Financeira, Contabilidade, Gestão de Pessoas e Legislação Trabalhista.</li><li><strong>Módulo III — Estratégia e Empreendedorismo:</strong> Marketing Digital, Gestão de Operações, Logística Empresarial e Plano de Negócios.</li></ul><h2>Campo de Atuação</h2><p>Empresas comerciais e industriais, órgãos públicos, instituições financeiras, escritórios de contabilidade e consultoria.</p>'
    ],
    'edificacoes' => [
        'titulo'  => 'Técnico em Edificações',
        'resumo'  => 'Formação em desenho técnico, elaboração de projetos arquitetônicos, orçamento e acompanhamento de obras.',
        'conteudo' => '<h2>Apresentação do Curso</h2><p>O Curso Técnico em Edificações prepara o estudante para participar diretamente no desenvolvimento, planejamento e execução de obras de engenharia civil e arquitetura, seguindo normas técnicas e de segurança.</p><h2>Perfil Profissional de Conclusão</h2><p>O egresso do curso estará preparado para:</p><ul><li>Desenhar e interpretar projetos arquitetônicos, estruturais e de instalações prediais.</li><li>Utilizar softwares de modelagem técnica e desenho (CAD e sistemas BIM).</li><li>Supervisionar canteiros de obras, controlando prazos, qualidade e materiais.</li><li>Realizar orçamentos, medições de obras e ensaios de laboratório de solos e concreto.</li></ul><h2>Estrutura Curricular (Módulos)</h2><ul><li><strong>Módulo I — Desenho e Topografia:</strong> Desenho Técnico, Topografia, Geometria Descritiva e Segurança do Trabalho.</li><li><strong>Módulo II — Materiais e Projetos:</strong> Materiais de Construção, Projetos Arquitetônicos, Instalações Elétricas e Hidrossanitárias.</li><li><strong>Módulo III — Gestão de Obras:</strong> Mecânica dos Solos, Planejamento e Orçamento de Obras e Patologia das Construções.</li></ul><h2>Campo de Atuação</h2><p>Construtoras, incorporadoras, escritórios de arquitetura e engenharia, empresas de reforma e órgãos públicos de fiscalização.</p>'
    ],
    'eletromecanica' => [
        'titulo'  => 'Técnico em Eletromecânica',
        'resumo'  => 'Integração de sistemas elétricos e mecânicos industriais, automação, comandos elétricos e usinagem.',
        'conteudo' => '<h2>Apresentação do Curso</h2><p>O Curso Técnico em Eletromecânica combina disciplinas de eletricidade, mecânica e automação, formando profissionais polivalentes para operar e manter máquinas industriais modernas.</p><h2>Perfil Profissional de Conclusão</h2><p>O egresso do curso estará preparado para:</p><ul><li>Montar, instalar e realizar manutenção preventiva e corretiva em máquinas eletromecânicas.</li><li>Interpretar esquemas elétricos industriais e desenhos mecânicos.</li><li>Programar e operar controladores lógicos programáveis (CLP) e sistemas automatizados.</li><li>Executar medições elétricas e mecânicas com instrumentos de precisão.</li></ul><h2>Estrutura Curricular (Módulos)</h2><ul><li><strong>Módulo I — Fundamentos Tecnológicos:</strong> Eletricidade Básica, Desenho Técnico Mecânico e Metrologia.</li><li><strong>Módulo II — Comandos e Mecânica:</strong> Comandos Elétricos, Elementos de Máquinas e Usinagem.</li><li><strong>Módulo III — Automação e Manutenção:</strong> Automação Industrial, Manutenção Eletromecânica e Termodinâmica.</li></ul><h2>Campo de Atuação</h2><p>Indústrias automobilísticas, alimentícias, têxteis, usinas de energia, empresas de manutenção e montagem industrial.</p>'
    ],
    'logistica' => [
        'titulo'  => 'Técnico em Logística',
        'resumo'  => 'Gestão da cadeia de suprimentos, controle de estoques, movimentação de cargas, armazenagem e transporte.',
        'conteudo' => '<h2>Apresentação do Curso</h2><p>O Curso Técnico em Logística visa capacitar estudantes para otimizar os fluxos de materiais, informações e recursos desde a origem dos insumos até a entrega do produto ao consumidor final.</p><h2>Perfil Profissional de Conclusão</h2><p>O egresso do curso estará preparado para:</p><ul><li>Planear e controlar o armazenamento, movimentação e inventário de estoques.</li><li>Dimensionar e gerenciar frotas de transporte e rotas de distribuição.</li><li>Operar sistemas de gestão logística (WMS, ERP e rastreamento de cargas).</li><li>Coordenar operações de compra, embalagem e logística reversa.</li></ul><h2>Estrutura Curricular (Módulos)</h2><ul><li><strong>Módulo I — Fundamentos Logísticos:</strong> Introdução à Logística, Gestão de Armazenagem e Embalagens.</li><li><strong>Módulo II — Transportes e Estoques:</strong> Gestão de Estoques, Modalidades de Transporte e Custos Logísticos.</li><li><strong>Módulo III — Supply Chain:</strong> Cadeia de Suprimentos (Supply Chain), Logística Internacional e Indicadores de Desempenho.</li></ul><h2>Campo de Atuação</h2><p>Centros de distribuição (CDs), transportadoras, operadores logísticos, indústrias, e-commerce, portos e aeroportos.</p>'
    ],
    'informatica' => [
        'titulo'  => 'Técnico em Informática',
        'resumo'  => 'Desenvolvimento de software, aplicações web e mobile, infraestrutura de redes, banco de dados e suporte.',
        'conteudo' => '<h2>Apresentação do Curso</h2><p>O Curso Técnico em Informática prepara o estudante para desenvolver sistemas de software, estruturar redes locais de computadores, gerenciar bancos de dados e fornecer suporte técnico em tecnologia da informação.</p><h2>Perfil Profissional de Conclusão</h2><p>O egresso do curso estará preparado para:</p><ul><li>Desenvolver aplicações Web e Mobile utilizando linguagens modernas de programação.</li><li>Modelar, implementar e administrar bancos de dados relacionais.</li><li>Configurar e gerenciar redes de computadores, roteadores e servidores.</li><li>Montar, diagnosticar e realizar manutenção em hardware e sistemas operacionais.</li></ul><h2>Estrutura Curricular (Módulos)</h2><ul><li><strong>Módulo I — Algoritmos e Hardware:</strong> Lógica de Programação, Arquitetura de Computadores e Redes.</li><li><strong>Módulo II — Desenvolvimento e Banco de Dados:</strong> Desenvolvimento Web (HTML/CSS/JS) e Banco de Dados SQL.</li><li><strong>Módulo III — Programação Avançada e Projetos:</strong> Desenvolvimento de APIs, Aplicações Mobile e Segurança da Informação.</li></ul><h2>Campo de Atuação</h2><p>Empresas de desenvolvimento de software, startups, departamentos de TI corporativos, provedores de internet e autônomo.</p>'
    ]
];

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);
$slug_req = end($parts);

$titulo = '';
$resumo = '';
$conteudo = '';

if (have_posts()) {
    while (have_posts()) {
        the_post();
        $db_content = trim(get_the_content());
        if (!empty($db_content)) {
            $titulo = get_the_title();
            $resumo = get_the_excerpt();
            $conteudo = apply_filters('the_content', $db_content);
        }
    }
}

if (empty($conteudo)) {
    if (isset($cursos_padrao[$slug_req])) {
        $info = $cursos_padrao[$slug_req];
        $titulo = $info['titulo'];
        $resumo = $info['resumo'];
        $conteudo = $info['conteudo'];
    } else {
        $titulo = 'Curso Técnico';
        $resumo = 'Formação profissional técnica da EEEP Professor Antonio Valmir da Silva.';
        $conteudo = '<p>Conteúdo do curso em atualização.</p>';
    }
}
?>

<article class="curso-single-page">
    <header class="curso-hero">
        <div class="container">
            <a href="<?php echo esc_url(home_url('/#cursos')); ?>" class="voltar-link">← Voltar para todos os cursos</a>
            <span class="curso-badge">Ensino Médio Integrado</span>
            <h1><?php echo esc_html($titulo); ?></h1>
            <?php if (!empty($resumo)) : ?>
                <p class="curso-excerpt"><?php echo esc_html($resumo); ?></p>
            <?php endif; ?>
        </div>
    </header>

    <section class="curso-ficha-tecnica">
        <div class="container ficha-grid">
            <div class="ficha-item">
                <span class="ficha-label">⏱️ Duração</span>
                <strong>3 Anos</strong>
            </div>
            <div class="ficha-item">
                <span class="ficha-label">📚 Carga Horária</span>
                <strong>3.600 Horas</strong>
            </div>
            <div class="ficha-item">
                <span class="ficha-label">☀️ Modalidade</span>
                <strong>Integral (Manhã e Tarde)</strong>
            </div>
            <div class="ficha-item">
                <span class="ficha-label">🎓 Titulação</span>
                <strong>Técnico de Nível Médio</strong>
            </div>
        </div>
    </section>

    <section class="curso-detalhes">
        <div class="container curso-layout-grid">
            <div class="curso-main-content">
                <div class="entry-content">
                    <?php echo $conteudo; ?>
                </div>

                <div class="curso-cta-box">
                    <h3>Quer estudar na EEEP Professor Antonio Valmir da Silva?</h3>
                    <p>Acompanhe os editais de seleção e garanta a sua vaga no Ensino Médio Integrado.</p>
                    <a href="<?php echo esc_url(get_template_directory_uri() . '/pdf/edital-2026.pdf'); ?>" target="_blank" rel="noopener" class="btn btn-primary">
                        Acessar Edital de Inscrição 📑
                    </a>
                </div>
            </div>

            <aside class="curso-sidebar">
                <div class="widget-curso">
                    <h3>🎓 Nossos Cursos</h3>
                    <ul class="lista-outros-cursos">
                        <li><a href="<?php echo esc_url(home_url('/curso/administracao')); ?>">Técnico em Administração</a></li>
                        <li><a href="<?php echo esc_url(home_url('/curso/edificacoes')); ?>">Técnico em Edificações</a></li>
                        <li><a href="<?php echo esc_url(home_url('/curso/eletromecanica')); ?>">Técnico em Eletromecânica</a></li>
                        <li><a href="<?php echo esc_url(home_url('/curso/logistica')); ?>">Técnico em Logística</a></li>
                        <li><a href="<?php echo esc_url(home_url('/curso/informatica')); ?>">Técnico em Informática</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>
</article>

<?php get_footer(); ?>
