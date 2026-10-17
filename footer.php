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

<script>
// Menu Mobile (Hambúrguer)
document.addEventListener('DOMContentLoaded', function() {
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

    // Restaurar Alto Contraste salvo
    if (localStorage.getItem('eeep_alto_contraste') === 'ativado') {
        document.body.classList.add('alto-contraste');
    }
});

// Funções de Acessibilidade
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
