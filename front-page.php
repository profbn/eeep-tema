<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<section id="interativos" class="eeep-home-interactives" aria-labelledby="eeep-interactive-title">
    <div class="container">
        <div class="eeep-section-intro">
            <div>
                <span class="eeep-section-eyebrow">Aprender e explorar</span>
                <h2 id="eeep-interactive-title">Conteúdos interativos por curso</h2>
                <p>Explore materiais e atividades publicados para cada uma das cinco formações técnicas.</p>
            </div>
            <a class="eeep-section-more" href="<?php echo esc_url(home_url('/conteudos-interativos/')); ?>">Ver todos os conteúdos ↗</a>
        </div>
        <div class="eeep-interactive-grid">
            <?php foreach (eeep_cursos_requeridos() as $slug => $nome) :
                $termo = get_term_by('slug', $slug, 'area_curso');
                $quantidade = $termo && !is_wp_error($termo) ? (int) $termo->count : 0;
            ?>
                <a class="eeep-interactive-tile" href="<?php echo esc_url(eeep_link_area_curso($slug)); ?>">
                    <span class="eeep-interactive-tile__icon" aria-hidden="true">↗</span>
                    <strong><?php echo esc_html($nome); ?></strong>
                    <small><?php echo $quantidade > 0
                        ? esc_html(sprintf(_n('%s material', '%s materiais', $quantidade, 'eeep-tema'), number_format_i18n($quantidade)))
                        : 'Materiais em preparação'; ?></small>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// Carrossel dos cinco cursos: imediatamente abaixo dos conteúdos interativos.
get_template_part('template-parts/carrossel-cursos');

// Carrossel das cinco publicações recentes, sem duplicar os mesmos posts em grade.
get_template_part('template-parts/carrossel-destaques');
?>

<?php get_footer(); ?>
