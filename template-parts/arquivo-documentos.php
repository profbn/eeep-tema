<?php
/**
 * Arquivos de editais e resultados com consulta por ano e paginação.
 */
if (!defined('ABSPATH')) exit;
$tipo = isset($args['tipo']) && $args['tipo'] === 'resultado' ? 'resultado' : 'edital';
$dados = eeep_documento_tipos()[$tipo];
$anos = eeep_documentos_anos_disponiveis($tipo);
$ano_selecionado = isset($_GET['ano']) ? absint(wp_unslash($_GET['ano'])) : 0;
?>
<section class="eeep-documentos-pagina" aria-labelledby="eeep-documentos-titulo">
    <div class="container">
        <header class="eeep-documentos-cabecalho">
            <span class="eeep-section-eyebrow">Documentos institucionais</span>
            <h1 id="eeep-documentos-titulo"><?php echo esc_html($dados['descricao']); ?></h1>
            <p>Consulte os documentos publicados pela escola. Os anos anteriores permanecem disponíveis para referência.</p>
        </header>

        <?php if ($anos) : ?>
            <form class="eeep-documentos-filtros" method="get" action="<?php echo esc_url(get_post_type_archive_link($tipo)); ?>">
                <label for="eeep-documentos-ano">Filtrar por ano</label>
                <select id="eeep-documentos-ano" name="ano">
                    <option value="">Todos os anos</option>
                    <?php foreach ($anos as $ano) : ?>
                        <option value="<?php echo esc_attr($ano); ?>" <?php selected($ano_selecionado, $ano); ?>>
                            <?php echo esc_html($ano); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Filtrar</button>
                <?php if ($ano_selecionado) : ?>
                    <a href="<?php echo esc_url(get_post_type_archive_link($tipo)); ?>">Limpar filtro</a>
                <?php endif; ?>
            </form>
        <?php endif; ?>

        <?php if (have_posts()) : ?>
            <div class="eeep-documentos-lista">
                <?php while (have_posts()) : the_post();
                    $documento_url = get_post_meta(get_the_ID(), 'eeep_documento_pdf', true);
                    $ano = eeep_documento_ano(get_the_ID());
                ?>
                    <article <?php post_class('eeep-documento-item'); ?>>
                        <div class="eeep-documento-info">
                            <span class="eeep-documento-ano"><?php echo esc_html($ano); ?></span>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 28)); ?></p>
                            <span class="eeep-documento-data">Publicado em <?php echo esc_html(get_the_date('d/m/Y')); ?></span>
                        </div>
                        <div class="eeep-documento-acoes">
                            <a href="<?php the_permalink(); ?>">Ver detalhes</a>
                            <?php if ($documento_url) : ?>
                                <a class="eeep-documento-pdf" href="<?php echo esc_url($documento_url); ?>" target="_blank" rel="noopener noreferrer">
                                    Abrir PDF <span aria-hidden="true">↗</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <nav class="eeep-documentos-paginacao" aria-label="Mais documentos">
                <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => '← Anteriores', 'next_text' => 'Próximos →')); ?>
            </nav>
        <?php else : ?>
            <div class="eeep-empty-state">
                <?php if ($ano_selecionado) : ?>
                    <p>Não há documentos publicados para <?php echo esc_html($ano_selecionado); ?>.</p>
                    <a href="<?php echo esc_url(get_post_type_archive_link($tipo)); ?>">Ver todos os anos</a>
                <?php else : ?>
                    <p>Os documentos serão exibidos aqui assim que forem publicados pela escola.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
