<?php
/**
 * Template da página "Conteúdos interativos" (RF-06 e RF-07).
 * Mostra todos os cinco cursos, mesmo sem atividade publicada.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<section class="eeep-institutional-page eeep-content-areas" aria-labelledby="areas-title">
    <div class="container">
        <div class="eeep-page-intro">
            <span class="eeep-section-eyebrow">Aprendizagem por curso</span>
            <h1 id="areas-title"><?php the_title(); ?></h1>
            <?php while (have_posts()) : the_post(); ?>
                <div class="eeep-intro-text"><?php the_content(); ?></div>
            <?php endwhile; ?>
        </div>

        <div class="eeep-area-grid">
            <?php foreach (eeep_cursos_requeridos() as $slug => $nome) :
                $term = get_term_by('slug', $slug, 'area_curso');
                $count = $term && !is_wp_error($term) ? (int) $term->count : 0;
                $curso = get_page_by_path($slug, OBJECT, 'curso');
            ?>
                <article class="eeep-area-card eeep-area-card--<?php echo esc_attr($slug); ?>">
                    <span class="eeep-area-card__index">CURSO TÉCNICO</span>
                    <h2><?php echo esc_html($nome); ?></h2>
                    <p><?php echo $count > 0
                        ? esc_html(sprintf(_n('%s conteúdo disponível', '%s conteúdos disponíveis', $count, 'eeep-tema'), number_format_i18n($count)))
                        : 'Os materiais deste curso serão publicados neste espaço.'; ?></p>
                    <div class="eeep-area-card__links">
                        <a class="eeep-area-card__primary" href="<?php echo esc_url(eeep_link_area_curso($slug)); ?>">
                            Ver conteúdos <span aria-hidden="true">↗</span>
                        </a>
                        <?php if ($curso && $curso->post_status === 'publish') : ?>
                            <a href="<?php echo esc_url(get_permalink($curso)); ?>">Sobre o curso</a>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
