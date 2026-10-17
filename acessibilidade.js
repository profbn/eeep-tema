document.addEventListener('DOMContentLoaded', function() {
    // --- 1. CONTROLE DE TAMANHO DA FONTE ---
    let currentZoom = 100;
    const step = 10;
    const minZoom = 80;
    const maxZoom = 140;

    const btnAumentar = document.getElementById('btn-aumentar-fonte');
    const btnDiminuir = document.getElementById('btn-diminuir-fonte');
    const btnReset    = document.getElementById('btn-reset-fonte');
    const btnContraste = document.getElementById('btn-alto-contraste');

    if (btnAumentar && btnDiminuir && btnReset) {
        btnAumentar.addEventListener('click', function() {
            if (currentZoom < maxZoom) {
                currentZoom += step;
                document.documentElement.style.fontSize = currentZoom + '%';
                localStorage.setItem('eeep_font_zoom', currentZoom);
            }
        });

        btnDiminuir.addEventListener('click', function() {
            if (currentZoom > minZoom) {
                currentZoom -= step;
                document.documentElement.style.fontSize = currentZoom + '%';
                localStorage.setItem('eeep_font_zoom', currentZoom);
            }
        });

        btnReset.addEventListener('click', function() {
            currentZoom = 100;
            document.documentElement.style.fontSize = '100%';
            localStorage.removeItem('eeep_font_zoom');
        });

        // Restaura fonte salva no navegador
        const savedZoom = localStorage.getItem('eeep_font_zoom');
        if (savedZoom) {
            currentZoom = parseInt(savedZoom, 10);
            document.documentElement.style.fontSize = currentZoom + '%';
        }
    }

    // --- 2. CONTROLE DE ALTO CONTRASTE ---
    if (btnContraste) {
        btnContraste.addEventListener('click', function() {
            document.body.classList.toggle('alto-contraste');
            const isContrast = document.body.classList.contains('alto-contraste');
            localStorage.setItem('eeep_alto_contraste', isContrast ? 'true' : 'false');
            this.setAttribute('aria-pressed', isContrast);
        });

        // Restaura contraste salvo no navegador
        if (localStorage.getItem('eeep_alto_contraste') === 'true') {
            document.body.classList.add('alto-contraste');
            btnContraste.setAttribute('aria-pressed', 'true');
        }
    }
});
