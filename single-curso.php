<?php
if (!defined('ABSPATH')) exit;
get_header();

$titulo = 'Curso Técnico';
$resumo = '';
$conteudo = '<p>Conteúdo do curso em atualização.</p>';

if (have_posts()) {
    while (have_posts()) {
        the_post();
        $titulo = get_the_title();
        $resumo = get_the_excerpt();
        $texto = get_the_content();
        if (trim(wp_strip_all_tags($texto)) !== '' || has_blocks($texto)) {
            $conteudo = apply_filters('the_content', $texto);
        }
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
                        <?php
                        $outros_cursos = get_posts(array(
                            'post_type' => 'curso',
                            'post_status' => 'publish',
                            'numberposts' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                        ));
                        foreach ($outros_cursos as $outro_curso) :
                        ?>
                            <li><a href="<?php echo esc_url(get_permalink($outro_curso)); ?>">
                                <?php echo esc_html(get_the_title($outro_curso)); ?>
                            </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
        </div>
    </section>
</article>

<?php get_footer(); ?>
