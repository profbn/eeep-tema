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
                    <li><a href="<?php echo esc_url(home_url('/curso/administracao')); ?>">Técnico em Administração</a></li>
                    <li><a href="<?php echo esc_url(home_url('/curso/edificacoes')); ?>">Técnico em Edificações</a></li>
                    <li><a href="<?php echo esc_url(home_url('/curso/eletromecanica')); ?>">Técnico em Eletromecânica</a></li>
                    <li><a href="<?php echo esc_url(home_url('/curso/logistica')); ?>">Técnico em Logística</a></li>
                    <li><a href="<?php echo esc_url(home_url('/curso/informatica')); ?>">Técnico em Informática</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
