<?php
/**
 * Carrossel dos cinco cursos técnicos (requisito RF-08).
 * Mantém a transição de cinco segundos e usa conteúdos reais do CPT curso.
 */
if (!defined('ABSPATH')) exit;

$slugs_cursos = array_keys(eeep_cursos_requeridos());
$cursos_slider = array();
foreach ($slugs_cursos as $slug) {
    $curso = get_page_by_path($slug, OBJECT, 'curso');
    if ($curso && $curso->post_status === 'publish') {
        $cursos_slider[] = $curso;
    }
}
$quantidade = count($cursos_slider);
?>
<section id="cursos" class="eeep-featured eeep-featured--courses" aria-label="Cursos técnicos em destaque">
    <div class="portal-shell">
        <div class="eeep-featured__eyebrow">
            <span class="eeep-live-dot" aria-hidden="true"></span>
            Ensino Médio Integrado à Educação Profissional
            <span class="eeep-featured__eyebrow-right">Conheça nossos cursos</span>
        </div>
        <div class="eeep-slider eeep-course-slider" data-eeep-slider data-interval="5000"
             aria-roledescription="carrossel" aria-label="Conheça os cinco cursos técnicos">
            <div class="eeep-slider__viewport" aria-live="off">
                <?php if ($quantidade > 0) : ?>
                    <?php foreach ($cursos_slider as $i => $curso) :
                        $img = get_the_post_thumbnail_url($curso->ID, 'full');
                        $resumo = has_excerpt($curso->ID)
                            ? get_the_excerpt($curso)
                            : wp_trim_words(wp_strip_all_tags($curso->post_content), 26, '…');
                        $label = get_the_title($curso);
                    ?>
                        <article class="eeep-slide<?php echo $i === 0 ? ' is-active' : ''; ?> eeep-course-slide eeep-course-slide--<?php echo esc_attr($curso->post_name); ?>"
                                 data-eeep-slide aria-roledescription="slide"
                                 aria-label="<?php echo esc_attr(($i + 1) . ' de ' . $quantidade . ': ' . $label); ?>"
                                 aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>"
                                 <?php echo $i === 0 ? '' : 'inert'; ?>>
                            <?php if ($img) : ?>
                                <img class="eeep-slide__image" src="<?php echo esc_url($img); ?>" alt=""
                                    <?php echo $i === 0 ? 'fetchpriority="high" loading="eager"' : 'loading="lazy"'; ?>
                                    decoding="async">
                            <?php endif; ?>
                            <div class="eeep-slide__pattern" aria-hidden="true"></div>
                            <div class="eeep-slide__shade" aria-hidden="true"></div>
                            <div class="eeep-slide__content">
                                <div class="eeep-slide__meta">
                                    <span class="eeep-slide__category">Curso <?php echo esc_html($i + 1); ?> de <?php echo esc_html($quantidade); ?></span>
                                    <span>Formação técnica</span>
                                </div>
                                <h2 class="eeep-slide__title">
                                    <a href="<?php echo esc_url(get_permalink($curso)); ?>" <?php echo $i === 0 ? '' : 'tabindex="-1"'; ?>>
                                        <?php echo esc_html($label); ?>
                                    </a>
                                </h2>
                                <?php if ($resumo) : ?>
                                    <p class="eeep-slide__summary"><?php echo esc_html($resumo); ?></p>
                                <?php endif; ?>
                                <a class="eeep-slide__cta" href="<?php echo esc_url(get_permalink($curso)); ?>"
                                    <?php echo $i === 0 ? '' : 'tabindex="-1"'; ?>>
                                    Conhecer este curso <span aria-hidden="true">↗</span>
                                </a>
                            </div>
                            <div class="eeep-slide__index" aria-hidden="true">
                                <?php echo esc_html(str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT)); ?>
                                /
                                <?php echo esc_html(str_pad((string) $quantidade, 2, '0', STR_PAD_LEFT)); ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else : ?>
                    <article class="eeep-slide is-active eeep-course-slide" data-eeep-slide aria-roledescription="slide" aria-label="Cursos técnicos" aria-hidden="false">
                        <div class="eeep-slide__pattern" aria-hidden="true"></div>
                        <div class="eeep-slide__shade" aria-hidden="true"></div>
                        <div class="eeep-slide__content">
                            <h2 class="eeep-slide__title">Conheça nossos cursos técnicos</h2>
                            <p class="eeep-slide__summary">Os cursos serão apresentados neste espaço após sua publicação.</p>
                            <a class="eeep-slide__cta" href="<?php echo esc_url(home_url('/#cursos')); ?>">Ver cursos</a>
                        </div>
                    </article>
                <?php endif; ?>
            </div>

            <?php if ($quantidade > 1) : ?>
                <div class="eeep-slider__controls" aria-label="Controles do carrossel de cursos">
                    <div class="eeep-slider__dots" role="group" aria-label="Selecionar curso">
                        <?php for ($dot = 0; $dot < $quantidade; $dot++) : ?>
                            <button type="button" data-eeep-dot="<?php echo esc_attr($dot); ?>"
                                class="eeep-slider__dot<?php echo $dot === 0 ? ' is-active' : ''; ?>"
                                aria-label="Mostrar curso <?php echo esc_attr($dot + 1); ?>"
                                aria-current="<?php echo $dot === 0 ? 'true' : 'false'; ?>"></button>
                        <?php endfor; ?>
                    </div>
                    <div class="eeep-slider__buttons">
                        <button type="button" class="eeep-slider__control eeep-slider__autoplay" data-eeep-pause
                                aria-label="Pausar transição automática" aria-pressed="false">Ⅱ</button>
                        <button type="button" class="eeep-slider__control" data-eeep-prev aria-label="Curso anterior">←</button>
                        <button type="button" class="eeep-slider__control" data-eeep-next aria-label="Próximo curso">→</button>
                    </div>
                </div>
                <p class="screen-reader-text" data-eeep-announcement aria-live="polite" aria-atomic="true"></p>
            <?php endif; ?>
        </div>
    </div>
</section>
