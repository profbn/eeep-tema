<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<section class="home-hero">
    <div class="container hero-content">
        <span class="hero-badge">Ensino Médio Integrado à Educação Profissional</span>
        <h1>EEEP Professor Antonio Valmir da Silva</h1>
        <p>Ensino de excelência, formação técnica profissional e preparação para o mercado de trabalho e universidade.</p>
        <a href="#cursos" class="btn btn-primary">Conheça nossos Cursos</a>
    </div>
</section>

<section class="home-atalhos">
    <div class="container">
        <div class="atalhos-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
            <a href="<?php echo esc_url(get_template_directory_uri() . '/pdf/edital-2026.pdf'); ?>" target="_blank" rel="noopener" class="atalho-card">
                <h3>📑 Edital 2026</h3>
                <p>Edital de Inscrição Valmir 2026 (PDF)</p>
            </a>
            <a href="<?php echo esc_url(get_template_directory_uri() . '/pdf/resultado-2025.pdf'); ?>" target="_blank" rel="noopener" class="atalho-card">
                <h3>📊 Resultado 2025</h3>
                <p>Resultado Final - Processo Seletivo (PDF)</p>
            </a>
            <a href="https://www.youtube.com/@EEEPPROFANTONIOVALMIR" target="_blank" rel="noopener" class="atalho-card">
                <h3>📺 Canal no YouTube</h3>
                <p>Acompanhe os vídeos e eventos da escola</p>
            </a>
        </div>
    </div>
</section>

<section id="cursos" class="home-cursos">
    <div class="container">
        <h2 style="color: var(--verde-brasil); margin-bottom: 20px;">Nossos Cursos Técnicos</h2>
        <div class="cursos-grid">
            <a href="<?php echo esc_url(home_url('/curso/administracao')); ?>" class="curso-card-link">
                <article class="curso-card">
                    <span class="curso-tag">Gestão</span>
                    <h3>Técnico em Administração</h3>
                    <p>Gestão empresarial, recursos humanos, finanças e logística organizacional.</p>
                    <span class="curso-saiba-mais">Ver detalhes do curso →</span>
                </article>
            </a>
            <a href="<?php echo esc_url(home_url('/curso/edificacoes')); ?>" class="curso-card-link">
                <article class="curso-card">
                    <span class="curso-tag">Construção Civil</span>
                    <h3>Técnico em Edificações</h3>
                    <p>Desenho técnico, projetos arquitetônicos, medições e acompanhamento de obras.</p>
                    <span class="curso-saiba-mais">Ver detalhes do curso →</span>
                </article>
            </a>
            <a href="<?php echo esc_url(home_url('/curso/eletromecanica')); ?>" class="curso-card-link">
                <article class="curso-card">
                    <span class="curso-tag">Indústria</span>
                    <h3>Técnico em Eletromecânica</h3>
                    <p>Manutenção industrial, automação, circuitos elétricos e sistemas mecânicos.</p>
                    <span class="curso-saiba-mais">Ver detalhes do curso →</span>
                </article>
            </a>
            <a href="<?php echo esc_url(home_url('/curso/logistica')); ?>" class="curso-card-link">
                <article class="curso-card">
                    <span class="curso-tag">Logística</span>
                    <h3>Técnico em Logística</h3>
                    <p>Gestão de estoque, cadeia de suprimentos, transporte e distribuição.</p>
                    <span class="curso-saiba-mais">Ver detalhes do curso →</span>
                </article>
            </a>
            <a href="<?php echo esc_url(home_url('/curso/informatica')); ?>" class="curso-card-link">
                <article class="curso-card">
                    <span class="curso-tag">Tecnologia</span>
                    <h3>Técnico em Informática</h3>
                    <p>Desenvolvimento de software, redes de computadores, banco de dados e sistemas.</p>
                    <span class="curso-saiba-mais">Ver detalhes do curso →</span>
                </article>
            </a>
        </div>
    </div>
</section>

<section class="home-noticias">
    <div class="container">
        <h2 style="color: var(--azul-brasil); margin-bottom: 24px;">Últimas Notícias e Avisos</h2>
        <div class="noticias-grid">
            <?php
            $noticias_query = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish'
            ));

            if ($noticias_query->have_posts()) :
                while ($noticias_query->have_posts()) : $noticias_query->the_post();
            ?>
                    <article class="noticia-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="noticia-img-link">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        <?php endif; ?>
                        <div class="noticia-body">
                            <span class="noticia-data">📅 <?php echo get_the_date('d/m/Y'); ?></span>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                            <a href="<?php the_permalink(); ?>" class="noticia-ler-mais">Ler notícia completa →</a>
                        </div>
                    </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <article class="noticia-card">
                    <div class="noticia-body">
                        <span class="noticia-data">📅 <?php echo date('d/m/Y'); ?></span>
                        <h3>Bem-vindo ao Novo Portal da EEEP Professor Antonio Valmir da Silva</h3>
                        <p>Acompanhe aqui as notícias, avisos e eventos escolares publicados pela nossa equipa.</p>
                    </div>
                </article>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
