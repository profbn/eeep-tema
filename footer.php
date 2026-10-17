<?php
if (!defined('ABSPATH')) exit;
?>
</main>

<footer class="site-footer">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> EEEP Professor Antonio Valmir da Silva. Todos os direitos reservados.</p>
        <p>Governo do Estado do Ceará — Secretaria da Educação (SEDUC)</p>
    </div>
</footer>

<!-- WIDGET OFICIAL VLIBRAS (ACESSIBILIDADE EM LIBRAS) -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>

<!-- SCRIPTS DE ACESSIBILIDADE E MENU MOBILE -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menu Mobile (Hambúrguer)
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');

    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            const isActive = navMenu.classList.toggle('is-active');
            menuToggle.classList.toggle('is-active');
            menuToggle.setAttribute('aria-expanded', isActive ? 'true' : 'false');
            menuToggle.setAttribute('aria-label', isActive ? 'Fechar Menu de Navegação' : 'Abrir Menu de Navegação');
        });
    }

    // Restaurar Alto Contraste salvo no navegador
    if (localStorage.getItem('eeep_alto_contraste') === 'ativado') {
        document.body.classList.add('alto-contraste');
    }
});

// Funções de Redimensionamento de Fonte
let tamanhoFonteAtual = 100;

function alterarFonte(fator) {
    tamanhoFonteAtual += fator * 10;
    if (tamanhoFonteAtual < 80) tamanhoFonteAtual = 80;
    if (tamanhoFonteAtual > 150) tamanhoFonteAtual = 150;
    document.body.style.fontSize = tamanhoFonteAtual + '%';
}

function resetarFonte() {
    tamanhoFonteAtual = 100;
    document.body.style.fontSize = '100%';
}

function alternarAltoContraste() {
    document.body.classList.toggle('alto-contraste');
    if (document.body.classList.contains('alto-contraste')) {
        localStorage.setItem('eeep_alto_contraste', 'ativado');
    } else {
        localStorage.setItem('eeep_alto_contraste', 'desativado');
    }
}
</script>

<?php wp_footer(); ?>
</body>
</html>
