<?php
/**
 * Página individual do curso — RF-08 até RF-12.
 * Grades e dados de inscrição são campos editáveis, não valores inventados.
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<?php while (have_posts()) : the_post();
    $id_curso = get_the_ID();
    $objetivos = get_post_meta($id_curso, 'eeep_curso_objetivo', true);
    $areas = get_post_meta($id_curso, 'eeep_curso_areas', true);
    $duracao = get_post_meta($id_curso, 'eeep_curso_duracao', true);
    $carga_horaria = get_post_meta($id_curso, 'eeep_curso_carga_horaria', true);
    $modalidade = get_post_meta($id_curso, 'eeep_curso_modalidade', true);
    $grade_pdf = get_post_meta($id_curso, 'eeep_grade_pdf', true);
    $edital = get_post_meta($id_curso, 'eeep_edital_url', true);
    $grade = array(
        '1º ano' => get_post_meta($id_curso, 'eeep_grade_ano_1', true),
        '2º ano' => get_post_meta($id_curso, 'eeep_grade_ano_2', true),
        '3º ano' => get_post_meta($id_curso, 'eeep_grade_ano_3', true),
    );
    $tem_grade = (bool) ($grade_pdf || implode('', array_values($grade)));
    $titulo = get_the_title();
?>
<article <?php post_class('curso-single-page'); ?>>
    <header class="curso-hero">
        <div class="container">
            <a href="<?php echo esc_url(home_url('/#cursos')); ?>" class="voltar-link">← Todos os cursos</a>
            <span class="curso-badge">Ensino Médio Integrado à Educação Profissional</span>
            <h1><?php echo esc_html($titulo); ?></h1>
            <?php if (has_excerpt()) : ?><p class="curso-excerpt"><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
        </div>
    </header>

    <?php if ($duracao || $carga_horaria || $modalidade) : ?>
        <section class="curso-ficha-tecnica" aria-label="Informações oficiais do curso">
            <div class="container ficha-grid">
                <?php foreach (array('Duração' => $duracao, 'Carga horária' => $carga_horaria, 'Modalidade' => $modalidade) as $rotulo => $valor) :
                    if (!$valor) continue; ?>
                    <div class="ficha-item">
                        <span class="ficha-label"><?php echo esc_html($rotulo); ?></span>
                        <strong><?php echo esc_html($valor); ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <div class="container eeep-course-anchor-links" role="navigation" aria-label="Nesta página">
        <a href="#apresentacao">Apresentação</a>
        <a href="#grade-curricular">Grade curricular</a>
        <a href="#candidatos">Para candidatos</a>
        <a href="#cursos-relacionados">Outros cursos</a>
    </div>

    <section class="curso-detalhes">
        <div class="container curso-layout-grid">
            <div class="curso-main-content">
                <section id="apresentacao" class="eeep-course-section">
                    <h2>Conheça o curso</h2>
                    <div class="entry-content"><?php the_content(); ?></div>
                </section>

                <?php if ($objetivos || $areas) : ?>
                <section class="eeep-course-section" aria-label="Objetivos e áreas de conhecimento">
                    <?php if ($objetivos) : ?>
                        <h2>Objetivos da formação</h2>
                        <p><?php echo nl2br(esc_html($objetivos)); ?></p>
                    <?php endif; ?>
                    <?php if ($areas) : ?>
                        <h2>Conhecimentos e áreas abordadas</h2>
                        <p><?php echo nl2br(esc_html($areas)); ?></p>
                    <?php endif; ?>
                </section>
                <?php endif; ?>

                <section id="grade-curricular" class="eeep-course-section">
                    <div class="eeep-section-header">
                        <span class="eeep-section-eyebrow">Componentes curriculares</span>
                        <h2>Grade curricular</h2>
                        <p>Consulte as disciplinas da formação de acordo com as informações fornecidas pela escola.</p>
                    </div>
                    <?php if ($tem_grade) : ?>
                        <div class="eeep-grade-grid">
                            <?php foreach ($grade as $periodo => $texto) :
                                $lista = eeep_lista_grade($texto);
                                if (!$lista) continue;
                            ?>
                                <section class="eeep-grade-card">
                                    <h3><?php echo esc_html($periodo); ?></h3>
                                    <?php echo $lista; // Lista gerada com esc_html em eeep_lista_grade(). ?>
                                </section>
                            <?php endforeach; ?>
                        </div>
                        <?php if ($grade_pdf) : ?>
                            <p class="eeep-grade-download">
                                <a href="<?php echo esc_url($grade_pdf); ?>" target="_blank" rel="noopener noreferrer">
                                    Consultar grade curricular oficial em PDF ↗
                                </a>
                            </p>
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="eeep-empty-state">
                            <p>A grade curricular oficial será disponibilizada após conferência das informações pela escola.</p>
                        </div>
                    <?php endif; ?>
                </section>

                <section id="candidatos" class="eeep-course-section">
                    <span class="eeep-section-eyebrow">Informações para candidatos</span>
                    <h2>Como saber mais sobre o ingresso</h2>
                    <p>As condições de inscrição, prazos e critérios de seleção são definidos pela instituição nos editais oficiais aplicáveis.</p>
                    <p>
                        <a class="btn btn-primary" href="<?php echo esc_url(get_post_type_archive_link('edital')); ?>">
                            Consultar editais e inscrições ↗
                        </a>
                    </p>
                    <?php if ($edital) : ?>
                        <p><a href="<?php echo esc_url($edital); ?>" target="_blank" rel="noopener noreferrer">
                            Abrir edital específico deste curso ↗
                        </a></p>
                    <?php endif; ?>
                </section>
            </div>

            <aside id="cursos-relacionados" class="curso-sidebar">
                <div class="widget-curso">
                    <h2>Outros cursos técnicos</h2>
                    <ul class="lista-outros-cursos">
                        <?php
                        foreach (eeep_cursos_requeridos() as $slug => $nome) :
                            $outro = get_page_by_path($slug, OBJECT, 'curso');
                            if (!$outro || $outro->post_status !== 'publish') continue;
                        ?>
                            <li><a href="<?php echo esc_url(get_permalink($outro)); ?>"
                                <?php echo $outro->ID === $id_curso ? 'aria-current="page"' : ''; ?>>
                                <?php echo esc_html(get_the_title($outro)); ?>
                            </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php
                $curso_area = get_term_by('slug', get_post_field('post_name', $id_curso), 'area_curso');
                if ($curso_area && !is_wp_error($curso_area)) :
                ?>
                <div class="widget-curso eeep-course-interactive-link">
                    <h2>Conteúdos interativos</h2>
                    <p>Explore atividades e materiais relacionados a este curso.</p>
                    <a href="<?php echo esc_url(eeep_link_area_curso($curso_area->slug)); ?>">Ver conteúdos do curso ↗</a>
                </div>
                <?php endif; ?>
            </aside>
        </div>
    </section>
</article>
<?php endwhile; ?>
<?php get_footer(); ?>
