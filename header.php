<?php
if (!defined('ABSPATH')) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary-content">Ir para o conteúdo principal</a>

<div class="top-accessibility-bar">
    <div class="container accessibility-flex">
        <span class="accessibility-title">Acessibilidade:</span>
        <div class="accessibility-buttons" role="group" aria-label="Preferências de leitura">
            <button type="button" id="btn-aumentar-fonte" aria-label="Aumentar fonte">A+</button>
            <button type="button" id="btn-diminuir-fonte" aria-label="Diminuir fonte">A-</button>
            <button type="button" id="btn-reset-fonte" aria-label="Restaurar tamanho da fonte">A</button>
            <button type="button" id="btn-alto-contraste" aria-label="Ativar alto contraste" aria-pressed="false">🌓 Alto contraste</button>
        </div>
    </div>
</div>

<header class="site-header">
    <div class="container header-flex">
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link" rel="home">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/logo.svg'); ?>" alt="" class="site-logo">
                </a>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-text" rel="home">
                <?php echo esc_html(get_bloginfo('name')); ?>
            </a>
        </div>

        <nav class="main-navigation" aria-label="Menu principal">
            <button class="menu-toggle" type="button" aria-expanded="false"
                    aria-controls="primary-menu" aria-label="Abrir menu de navegação">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'nav-menu',
                'menu_id' => 'primary-menu',
                'depth' => 3,
                'fallback_cb' => 'eeep_menu_padrao',
            ));
            ?>
        </nav>
    </div>
</header>

<?php get_template_part('template-parts/carrossel-destaques'); ?>

<main id="primary-content" tabindex="-1">
