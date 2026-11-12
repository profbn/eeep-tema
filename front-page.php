<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<section class="home-hero">
    <div class="container hero-content">
        <span class="hero-badge">Ensino Médio Integrado à Educação Profissional</span>
        <h1><?php echo esc_html(get_bloginfo('name')); ?></h1>
        <p>Ensino de excelência, formação técnica profissional e preparação para o mercado de trabalho e universidade.</p>
        <a href="#cursos" class="btn btn-primary">Conheça nossos Cursos</a>
    </div>
</section>

<section class="home-atalhos">
    <div class="container">
        <div class="atalhos-grid">
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
        <h2>Nossos Cursos Técnicos</h2>
        <div class="cursos-grid">
            <?php
            $cursos_query = new WP_Query(array(
                'post_type' => 'curso',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'no_found_rows' => true,
            ));
            $areas = array(
                'administracao' => 'Gestão',
                'edificacoes' => 'Construção Civil',
                'eletromecanica' => 'Indústria',
                'logistica' => 'Logística',
                'informatica' => 'Tecnologia',
            );
            if ($cursos_query->have_posts()) :
                while ($cursos_query->have_posts()) : $cursos_query->the_post();
                    $resumo = get_the_excerpt();
                    if (!$resumo) {
                        $resumo = wp_trim_words(wp_strip_all_tags(get_the_content()), 22);
                    }
                    $area = isset($areas[get_post_field('post_name', get_the_ID())])
                        ? $areas[get_post_field('post_name', get_the_ID())] : 'Curso Técnico';
                    ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="curso-card-link">
                        <article class="curso-card">
                            <span class="curso-tag"><?php echo esc_html($area); ?></span>
                            <h3><?php echo esc_html(get_the_title()); ?></h3>
                            <p><?php echo esc_html($resumo); ?></p>
                            <span class="curso-saiba-mais">Ver detalhes do curso →</span>
                        </article>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p>Os cursos técnicos serão publicados em breve.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="home-noticias">
    <div class="container">
        <h2>Últimas Notícias e Avisos</h2>
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
                        <?php
                        $imagem_noticia = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium_large') : eeep_obter_imagem_post(get_the_ID());
                        if ($imagem_noticia) :
                        ?>
                            <a href="<?php the_permalink(); ?>" class="noticia-img-link">
                                <img loading="lazy" decoding="async" src="<?php echo esc_url($imagem_noticia); ?>" alt="">
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
