<?php
if (!defined('ABSPATH')) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_uri()); ?>?v=<?php echo time(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary-content">Ir para o conteúdo principal</a>

<div class="top-accessibility-bar">
    <div class="container accessibility-flex">
        <span class="accessibility-title">Acessibilidade:</span>
        <div class="accessibility-buttons">
            <button type="button" onclick="alterarFonte(1)" aria-label="Aumentar fonte">A+</button>
            <button type="button" onclick="alterarFonte(-1)" aria-label="Diminuir fonte">A-</button>
            <button type="button" onclick="resetarFonte()" aria-label="Restaurar tamanho da fonte">A</button>
            <button type="button" onclick="alternarAltoContraste()" aria-label="Alternar Alto Contraste">🌓 Alto Contraste</button>
        </div>
    </div>
</div>

<header class="site-header">
    <div class="container header-flex">
        <div class="site-branding">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/logo.svg'); ?>" alt="EEEP Professor Antonio Valmir da Silva" class="site-logo">
                <span class="site-title-text">EEEP – Professor Antonio Valmir da Silva</span>
            </a>
        </div>

        <nav class="main-navigation" aria-label="Menu Principal">
            <ul class="nav-menu">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Início</a></li>
                <li><a href="<?php echo esc_url(home_url('/#cursos')); ?>">Cursos</a></li>
                <li><a href="<?php echo esc_url(get_template_directory_uri() . '/pdf/edital-2026.pdf'); ?>" target="_blank" rel="noopener">Edital 2026 📑</a></li>
                <li><a href="<?php echo esc_url(get_template_directory_uri() . '/pdf/resultado-2025.pdf'); ?>" target="_blank" rel="noopener">Resultado 2025 📊</a></li>
                <li><a href="https://www.youtube.com/@EEEPPROFANTONIOVALMIR" target="_blank" rel="noopener" class="nav-btn-yt">YouTube 📺</a></li>
            </ul>
        </nav>
    </div>
</header>
<main id="primary-content">
