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

<!-- SCRIPT DE ACESSIBILIDADE (A+, A-, A, ALTO CONTRASTE) -->
<script>
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

// Manter o modo de alto contraste ativo ao mudar de página
document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('eeep_alto_contraste') === 'ativado') {
        document.body.classList.add('alto-contraste');
    }
});
</script>

<?php wp_footer(); ?>
</body>
</html>
