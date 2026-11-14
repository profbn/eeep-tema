<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<section class="eeep-about-teaser" aria-label="Nossa escola">
    <div class="container eeep-about-teaser__grid">
        <div>
            <span class="eeep-section-eyebrow">Nossa escola</span>
            <h2>Conheça a EEEP Professor Antônio Valmir da Silva</h2>
            <p>História da instituição, trajetória escolar e informações sobre a origem de seu nome.</p>
        </div>
        <a class="eeep-about-teaser__link" href="<?php echo esc_url(home_url('/sobre-a-escola/')); ?>">
            Sobre a escola <span aria-hidden="true">↗</span>
        </a>
    </div>
</section>

<?php
// O ano e a descrição são sempre os da publicação mais recente cadastrada.
$edital_recente = eeep_documento_mais_recente('edital');
$resultado_recente = eeep_documento_mais_recente('resultado');
?>
<section class="home-atalhos eeep-home-servicos" aria-label="Editais, resultados e redes sociais">
    <div class="container">
        <div class="atalhos-grid">
            <a href="<?php echo esc_url(get_post_type_archive_link('edital')); ?>" class="atalho-card eeep-atalho-documento">
                <span class="eeep-atalho-icone" aria-hidden="true">📑</span>
                <h3>Editais</h3>
                <?php if ($edital_recente) : ?>
                    <p><strong>Mais recente: <?php echo esc_html(eeep_documento_ano($edital_recente->ID)); ?></strong></p>
                    <p><?php echo esc_html(get_the_title($edital_recente)); ?></p>
                <?php else : ?>
                    <p>Acesse os editais publicados pela escola, organizados por ano.</p>
                <?php endif; ?>
                <span class="eeep-atalho-acao">Consultar todos os editais ↗</span>
            </a>

            <a href="<?php echo esc_url(get_post_type_archive_link('resultado')); ?>" class="atalho-card eeep-atalho-documento">
                <span class="eeep-atalho-icone" aria-hidden="true">📊</span>
                <h3>Resultados</h3>
                <?php if ($resultado_recente) : ?>
                    <p><strong>Mais recente: <?php echo esc_html(eeep_documento_ano($resultado_recente->ID)); ?></strong></p>
                    <p><?php echo esc_html(get_the_title($resultado_recente)); ?></p>
                <?php else : ?>
                    <p>Consulte os resultados publicados pela escola, por ano.</p>
                <?php endif; ?>
                <span class="eeep-atalho-acao">Consultar todos os resultados ↗</span>
            </a>

            <a href="https://www.youtube.com/@EEEPPROFANTONIOVALMIR" target="_blank" rel="noopener noreferrer" class="atalho-card">
                <span class="eeep-atalho-icone" aria-hidden="true">▶</span>
                <h3>Canal no YouTube</h3>
                <p>Vídeos, atividades e eventos da comunidade escolar.</p>
                <span class="eeep-atalho-acao">Acessar canal ↗</span>
            </a>

            <a href="https://www.instagram.com/eeepprofessorvalmir/" target="_blank" rel="noopener noreferrer" class="atalho-card">
                <span class="eeep-atalho-icone" aria-hidden="true">◎</span>
                <h3>Instagram</h3>
                <p>Acompanhe as publicações e novidades da escola.</p>
                <span class="eeep-atalho-acao">Abrir Instagram ↗</span>
            </a>
        </div>
    </div>
</section>

<?php
// Primeira seção: cinco cursos técnicos, com transição automática a cada 5s.
get_template_part('template-parts/carrossel-cursos');
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
// Publicações recentes ficam em um carrossel separado, depois dos serviços.
get_template_part('template-parts/carrossel-destaques');
?>

<?php get_footer(); ?>
