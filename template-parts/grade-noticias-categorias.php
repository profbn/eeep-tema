<?php
/**
 * Quatro notícias selecionadas por categoria no painel.
 * Cada coluna usa a publicação mais recente da categoria configurada.
 */
if (!defined('ABSPATH')) exit;

$cartoes = eeep_obter_grade_noticias();
?>
<section class="eeep-category-news" aria-labelledby="eeep-category-news-title">
    <div class="portal-shell">
        <header class="eeep-category-news__heading">
            <div>
                <span class="eeep-category-news__eyebrow">Destaques por assunto</span>
                <h2 id="eeep-category-news-title">Explore nossas notícias</h2>
            </div>
            <p>As últimas publicações das categorias selecionadas pela escola.</p>
        </header>

        <?php if ($cartoes) : ?>
            <div class="eeep-category-news__grid">
                <?php foreach ($cartoes as $indice => $dados) :
                    $post = $dados['post'];
                    $cat = $dados['category'];
                    $imagem = get_the_post_thumbnail_url($post->ID, 'large');
                    if (!$imagem) $imagem = eeep_obter_imagem_post($post->ID);

                    $titulo = get_the_title($post);
                    $url = get_permalink($post);
                    $nome_categoria = $cat ? $cat->name : 'Notícias';
                    $resumo = get_the_excerpt($post);
                    if (!$resumo) {
                        $resumo = wp_strip_all_tags(strip_shortcodes($post->post_content));
                    }
                    $resumo = wp_trim_words($resumo, 20, '…');
                    $autor = get_the_author_meta('display_name', (int) $post->post_author);
                ?>
                    <article class="eeep-category-news__card eeep-category-news__card--<?php echo esc_attr(($indice % 4) + 1); ?>">
                        <a class="eeep-category-news__photo" href="<?php echo esc_url($url); ?>"
                           aria-label="<?php echo esc_attr('Ler: ' . $titulo); ?>" tabindex="-1">
                            <?php if ($imagem) : ?>
                                <img src="<?php echo esc_url($imagem); ?>" alt="" loading="lazy" decoding="async">
                            <?php else : ?>
                                <span class="eeep-category-news__image-placeholder" aria-hidden="true">
                                    <span>EEEP</span>
                                    <span>Notícias da escola</span>
                                </span>
                            <?php endif; ?>
                        </a>
                        <div class="eeep-category-news__body">
                            <?php if ($cat) : ?>
                                <a class="eeep-category-news__category" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
                                    <?php echo esc_html($nome_categoria); ?>
                                </a>
                            <?php else : ?>
                                <span class="eeep-category-news__category"><?php echo esc_html($nome_categoria); ?></span>
                            <?php endif; ?>

                            <h3 class="eeep-category-news__title">
                                <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($titulo); ?></a>
                            </h3>
                            <div class="eeep-category-news__byline">
                                <?php if ($autor) : ?>
                                    <span><?php echo esc_html($autor); ?></span>
                                    <span aria-hidden="true">•</span>
                                <?php endif; ?>
                                <time datetime="<?php echo esc_attr(get_the_date('c', $post)); ?>">
                                    <?php echo esc_html(get_the_date('d/m/Y', $post)); ?>
                                </time>
                            </div>
                            <?php if ($resumo) : ?>
                                <p class="eeep-category-news__excerpt"><?php echo esc_html($resumo); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="eeep-category-news__empty">As notícias desta seção aparecerão quando a escola publicar matérias nas categorias escolhidas.</p>
        <?php endif; ?>
    </div>
</section>
