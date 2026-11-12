<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<section class="pagina-404">
    <div class="container">
        <div class="box-404">
            <span class="codigo-404">404</span>
            <h1>Página Não Encontrada</h1>
            <p>Lamentamos, mas o endereço que procura não existe, foi alterado ou está temporariamente indisponível.</p>

            <div class="botoes-404">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">🏠 Voltar à Página Inicial</a>
                <a href="<?php echo esc_url(home_url('/#cursos')); ?>" class="btn btn-secondary">🎓 Ver Cursos Técnicos</a>
            </div>

            <div class="atalhos-404">
                <h3>Acesso Rápido aos Cursos da EEEP:</h3>
                <ul>
                    <?php
                    $cursos = get_posts(array(
                        'post_type' => 'curso',
                        'numberposts' => -1,
                        'post_status' => 'publish',
                        'orderby' => 'title',
                        'order' => 'ASC',
                    ));
                    foreach ($cursos as $curso) :
                    ?>
                        <li><a href="<?php echo esc_url(get_permalink($curso)); ?>"><?php echo esc_html(get_the_title($curso)); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
