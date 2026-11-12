<?php
/**
 * Destaques dinâmicos do portal, exibidos abaixo do menu em todas as páginas.
 * Até cinco notícias recentes; fotos destacadas ou miniaturas do YouTube quando disponíveis.
 */
if (!defined('ABSPATH')) exit;

$destaques = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'ignore_sticky_posts' => false,
    'no_found_rows' => true,
));
$quantidade = (int) $destaques->post_count;
?>
<section class="eeep-featured" aria-label="Destaques do portal">
    <div class="portal-shell">
        <div class="eeep-featured__eyebrow">
            <span class="eeep-live-dot" aria-hidden="true"></span>
            Portal de notícias e informações
            <span class="eeep-featured__eyebrow-right">Educação profissional • Ceará</span>
        </div>
        <div class="eeep-slider" data-eeep-slider data-slides="<?php echo esc_attr(max($quantidade, 1)); ?>" aria-roledescription="carrossel" aria-label="Publicações em destaque">
            <div class="eeep-slider__viewport" aria-live="off">
                <?php if ($destaques->have_posts()) : ?>
                    <?php $i = 0; while ($destaques->have_posts()) : $destaques->the_post();
                        $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        if (!$img) {
                            $img = eeep_obter_imagem_post(get_the_ID());
                        }
                        $categorias = get_the_category();
                        $nome_categoria = !empty($categorias) ? $categorias[0]->name : 'Últimas notícias';
                        $resumo = get_the_excerpt();
                        if (!$resumo) {
                            $resumo = wp_trim_words(wp_strip_all_tags(strip_shortcodes(get_the_content())), 24, '…');
                        }
                    ?>
                    <article class="eeep-slide<?php echo $i === 0 ? ' is-active' : ''; ?>"
                            data-eeep-slide aria-roledescription="slide"
                            aria-label="<?php echo esc_attr(($i + 1) . ' de ' . $quantidade); ?>"
                            aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">
                        <?php if ($img) : ?>
                            <img class="eeep-slide__image" src="<?php echo esc_url($img); ?>" alt=""
                                 <?php echo $i === 0 ? 'fetchpriority="high" loading="eager"' : 'loading="lazy"'; ?>
                                 decoding="async">
                        <?php endif; ?>
                        <div class="eeep-slide__pattern" aria-hidden="true"></div>
                        <div class="eeep-slide__shade" aria-hidden="true"></div>
                        <div class="eeep-slide__content">
                            <div class="eeep-slide__meta">
                                <span class="eeep-slide__category"><?php echo esc_html($nome_categoria); ?></span>
                                <span><?php echo esc_html(get_the_date('d/m/Y')); ?></span>
                            </div>
                            <h2 class="eeep-slide__title">
                                <a href="<?php echo esc_url(get_permalink()); ?>" <?php echo $i === 0 ? '' : 'tabindex="-1"'; ?>>
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </h2>
                            <?php if ($resumo) : ?><p class="eeep-slide__summary"><?php echo esc_html($resumo); ?></p><?php endif; ?>
                            <a class="eeep-slide__cta" href="<?php echo esc_url(get_permalink()); ?>"
                               <?php echo $i === 0 ? '' : 'tabindex="-1"'; ?>>Ler publicação <span aria-hidden="true">↗</span></a>
                        </div>
                        <div class="eeep-slide__index" aria-hidden="true"><?php echo esc_html(str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT)); ?> / <?php echo esc_html(str_pad((string)$quantidade, 2, '0', STR_PAD_LEFT)); ?></div>
                    </article>
                    <?php $i++; endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <article class="eeep-slide is-active" data-eeep-slide aria-roledescription="slide" aria-label="1 de 1" aria-hidden="false">
                        <div class="eeep-slide__pattern" aria-hidden="true"></div>
                        <div class="eeep-slide__shade" aria-hidden="true"></div>
                        <div class="eeep-slide__content">
                            <div class="eeep-slide__meta"><span class="eeep-slide__category">Bem-vindo</span></div>
                            <h2 class="eeep-slide__title">Conhecimento que transforma o futuro.</h2>
                            <p class="eeep-slide__summary">Descubra nossos cursos técnicos e acompanhe as novidades da escola.</p>
                            <a class="eeep-slide__cta" href="<?php echo esc_url(home_url('/#cursos')); ?>">Conhecer os cursos <span aria-hidden="true">↗</span></a>
                        </div>
                    </article>
                <?php endif; ?>
            </div>

            <?php if ($quantidade > 1) : ?>
                <div class="eeep-slider__controls" aria-label="Controles dos destaques">
                    <div class="eeep-slider__dots" role="group" aria-label="Selecionar destaque">
                        <?php for ($dot = 0; $dot < $quantidade; $dot++) : ?>
                            <button type="button" class="eeep-slider__dot<?php echo $dot === 0 ? ' is-active' : ''; ?>"
                                    data-eeep-dot="<?php echo esc_attr($dot); ?>"
                                    aria-label="Mostrar destaque <?php echo esc_attr($dot + 1); ?>"
                                    aria-current="<?php echo $dot === 0 ? 'true' : 'false'; ?>"></button>
                        <?php endfor; ?>
                    </div>
                    <div class="eeep-slider__buttons">
                        <button type="button" class="eeep-slider__control eeep-slider__autoplay" data-eeep-pause aria-label="Pausar transição automática" aria-pressed="false" title="Pausar animação">Ⅱ</button>
                        <button type="button" class="eeep-slider__control" data-eeep-prev aria-label="Destaque anterior" title="Anterior">←</button>
                        <button type="button" class="eeep-slider__control" data-eeep-next aria-label="Próximo destaque" title="Próximo">→</button>
                    </div>
                </div>
                <p class="screen-reader-text" data-eeep-announcement aria-live="polite" aria-atomic="true"></p>
            <?php endif; ?>
        </div>
    </div>
</section>
