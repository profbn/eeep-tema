<?php
/**
 * Portal de notícias e informações: carrossel editorial 2026.
 * Layout em duas colunas, com fotografia e painel de leitura separados.
 * Mantém a seleção automática dos cinco posts mais recentes.
 */
if (!defined('ABSPATH')) exit;

$noticias = new WP_Query(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
    'ignore_sticky_posts' => true,
    'no_found_rows' => true,
));
$total = (int) $noticias->post_count;
?>
<section class="eeep-featured eeep-featured--news" aria-labelledby="eeep-news-heading">
    <div class="portal-shell">
        <header class="eeep-news-heading">
            <div>
                <span class="eeep-news-kicker">Acontece na escola</span>
                <h2 id="eeep-news-heading">Portal de notícias e informações</h2>
                <p>Publicações, atividades e novidades da comunidade escolar.</p>
            </div>
            <?php
            $pagina_posts = (int) get_option('page_for_posts');
            if ($pagina_posts) :
            ?>
                <a class="eeep-news-all" href="<?php echo esc_url(get_permalink($pagina_posts)); ?>">Ver todas as publicações ↗</a>
            <?php endif; ?>
        </header>

        <div class="eeep-slider eeep-news-slider" data-eeep-slider data-interval="5000"
            aria-roledescription="carrossel" aria-label="Cinco publicações mais recentes">
            <div class="eeep-slider__viewport" aria-live="off">
                <?php if ($noticias->have_posts()) :
                    $indice = 0;
                    while ($noticias->have_posts()) : $noticias->the_post();
                        $imagem = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        if (!$imagem) $imagem = eeep_obter_imagem_post(get_the_ID());
                        $categorias = get_the_category();
                        $categoria = !empty($categorias) ? $categorias[0]->name : 'Comunicado';
                        $resumo = get_the_excerpt();
                        if (!$resumo) $resumo = wp_trim_words(wp_strip_all_tags(strip_shortcodes(get_the_content())), 28, '…');
                        $ativo = $indice === 0;
                ?>
                    <article class="eeep-slide eeep-news-slide<?php echo $ativo ? ' is-active' : ''; ?>"
                        data-eeep-slide aria-roledescription="slide"
                        aria-label="<?php echo esc_attr(($indice + 1) . ' de ' . $total . ': ' . get_the_title()); ?>"
                        aria-hidden="<?php echo $ativo ? 'false' : 'true'; ?>"
                        <?php echo $ativo ? '' : 'inert'; ?>>
                        <div class="eeep-news-slide__media">
                            <?php if ($imagem) : ?>
                                <img class="eeep-news-slide__image" src="<?php echo esc_url($imagem); ?>"
                                    alt="" decoding="async"
                                    <?php echo $ativo ? 'loading="eager"' : 'loading="lazy"'; ?>>
                            <?php else : ?>
                                <div class="eeep-news-slide__fallback" aria-hidden="true">
                                    <span class="eeep-news-slide__symbol">✦</span>
                                    <span class="eeep-news-slide__fallback-text">Informação que conecta</span>
                                </div>
                            <?php endif; ?>
                            <div class="eeep-news-slide__media-label">
                                <span class="eeep-news-slide__media-dot" aria-hidden="true"></span>
                                EEEP • Notícias
                            </div>
                            <div class="eeep-news-slide__number" aria-hidden="true">
                                <?php echo esc_html(str_pad((string) ($indice + 1), 2, '0', STR_PAD_LEFT)); ?>
                                <span>/ <?php echo esc_html(str_pad((string) $total, 2, '0', STR_PAD_LEFT)); ?></span>
                            </div>
                        </div>
                        <div class="eeep-news-slide__content">
                            <div class="eeep-news-slide__meta">
                                <span class="eeep-news-slide__category"><?php echo esc_html($categoria); ?></span>
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo esc_html(get_the_date('d/m/Y')); ?>
                                </time>
                            </div>
                            <h3 class="eeep-news-slide__title">
                                <a href="<?php echo esc_url(get_permalink()); ?>"
                                    <?php echo $ativo ? '' : 'tabindex="-1"'; ?>><?php echo esc_html(get_the_title()); ?></a>
                            </h3>
                            <?php if ($resumo) : ?>
                                <p class="eeep-news-slide__summary"><?php echo esc_html($resumo); ?></p>
                            <?php endif; ?>
                            <a class="eeep-news-slide__link" href="<?php echo esc_url(get_permalink()); ?>"
                                <?php echo $ativo ? '' : 'tabindex="-1"'; ?>>
                                Ler publicação completa <span aria-hidden="true">↗</span>
                            </a>
                        </div>
                    </article>
                <?php
                    $indice++;
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <article class="eeep-slide eeep-news-slide is-active" data-eeep-slide
                        aria-roledescription="slide" aria-label="Nenhuma publicação" aria-hidden="false">
                        <div class="eeep-news-slide__media">
                            <div class="eeep-news-slide__fallback" aria-hidden="true">
                                <span class="eeep-news-slide__symbol">✦</span>
                            </div>
                        </div>
                        <div class="eeep-news-slide__content">
                            <span class="eeep-news-slide__category">Comunidade escolar</span>
                            <h3 class="eeep-news-slide__title">Notícias e informações da escola</h3>
                            <p class="eeep-news-slide__summary">As próximas publicações serão apresentadas neste espaço.</p>
                        </div>
                    </article>
                <?php endif; ?>
            </div>

            <?php if ($total > 1) : ?>
                <div class="eeep-slider__controls eeep-news-slider__controls" aria-label="Navegar nas notícias">
                    <div class="eeep-slider__dots" role="group" aria-label="Selecionar publicação">
                        <?php for ($i = 0; $i < $total; $i++) : ?>
                            <button type="button" class="eeep-slider__dot<?php echo $i === 0 ? ' is-active' : ''; ?>"
                                data-eeep-dot="<?php echo esc_attr($i); ?>"
                                aria-label="Mostrar notícia <?php echo esc_attr($i + 1); ?>"
                                aria-current="<?php echo $i === 0 ? 'true' : 'false'; ?>"></button>
                        <?php endfor; ?>
                    </div>
                    <div class="eeep-slider__buttons">
                        <button type="button" class="eeep-slider__control" data-eeep-pause
                            aria-label="Pausar transição automática" aria-pressed="false">Ⅱ</button>
                        <button type="button" class="eeep-slider__control" data-eeep-prev
                            aria-label="Notícia anterior">←</button>
                        <button type="button" class="eeep-slider__control" data-eeep-next
                            aria-label="Próxima notícia">→</button>
                    </div>
                </div>
                <p class="screen-reader-text" data-eeep-announcement aria-live="polite" aria-atomic="true"></p>
            <?php endif; ?>
        </div>
    </div>
</section>
