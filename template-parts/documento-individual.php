<?php
/**
 * Página de cada edital ou resultado com link ao PDF correspondente.
 */
if (!defined('ABSPATH')) exit;
$tipo = isset($args['tipo']) && $args['tipo'] === 'resultado' ? 'resultado' : 'edital';
$descricao = eeep_documento_tipos()[$tipo]['descricao'];
?>
<section class="eeep-documentos-pagina" aria-label="<?php echo esc_attr($descricao); ?>">
    <div class="container">
        <a class="eeep-back-link" href="<?php echo esc_url(get_post_type_archive_link($tipo)); ?>">← Todos os <?php echo esc_html($tipo === 'edital' ? 'editais' : 'resultados'); ?></a>
        <?php while (have_posts()) : the_post();
            $ano = eeep_documento_ano(get_the_ID());
            $documento_url = get_post_meta(get_the_ID(), 'eeep_documento_pdf', true);
        ?>
        <article <?php post_class('eeep-documento-inteiro'); ?>>
            <span class="eeep-documento-ano"><?php echo esc_html($ano); ?></span>
            <h1><?php the_title(); ?></h1>
            <p class="eeep-documento-data">Publicado em <?php echo esc_html(get_the_date('d/m/Y')); ?></p>
            <div class="entry-content"><?php the_content(); ?></div>
            <?php if ($documento_url) : ?>
                <p class="eeep-documento-download">
                    <a href="<?php echo esc_url($documento_url); ?>" target="_blank" rel="noopener noreferrer">
                        Abrir documento oficial em PDF <span aria-hidden="true">↗</span>
                    </a>
                </p>
            <?php else : ?>
                <p class="eeep-soft-note">O arquivo PDF não foi disponibilizado nesta publicação.</p>
            <?php endif; ?>
        </article>
        <?php endwhile; ?>
    </div>
</section>
