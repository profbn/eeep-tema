<?php
if (!defined('ABSPATH')) exit;
?>
</main>

<footer class="site-footer">
    <div class="container">
        <p>&copy; <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?>. Todos os direitos reservados.</p>
        <p>Governo do Estado do Ceará — Secretaria da Educação (SEDUC)</p>
    </div>
</footer>

<!-- VLibras: a biblioteca e a inicialização são enfileiradas em functions.php. -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
