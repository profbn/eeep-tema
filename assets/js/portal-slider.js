/**
 * Carrossel de notícias: navegação manual, transição suave e pausa acessível.
 * Avança a cada 5 segundos. Pausa mediante botão ou preferência por menos movimento.
 */
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    document.querySelectorAll('[data-eeep-slider]').forEach(function (slider) {
        const slides = Array.from(slider.querySelectorAll('[data-eeep-slide]'));
        const dots = Array.from(slider.querySelectorAll('[data-eeep-dot]'));
        const previous = slider.querySelector('[data-eeep-prev]');
        const next = slider.querySelector('[data-eeep-next]');
        const pause = slider.querySelector('[data-eeep-pause]');
        const announcement = slider.querySelector('[data-eeep-announcement]');
        if (slides.length < 2) return;

        let index = 0;
        let timer = null;
        let manuallyPaused = false;
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
        const INTERVAL = 5000;

        function isPaused() {
            return manuallyPaused || document.hidden || reduceMotion.matches;
        }

        function render(nextIndex, announce) {
            index = (nextIndex + slides.length) % slides.length;
            slides.forEach(function (slide, i) {
                const current = i === index;
                slide.classList.toggle('is-active', current);
                slide.setAttribute('aria-hidden', String(!current));
                if (current) slide.removeAttribute('inert');
                else slide.setAttribute('inert', '');

                slide.querySelectorAll('a, button').forEach(function (element) {
                    if (current) element.removeAttribute('tabindex');
                    else element.setAttribute('tabindex', '-1');
                });
            });

            dots.forEach(function (dot, i) {
                const current = i === index;
                dot.classList.toggle('is-active', current);
                dot.setAttribute('aria-current', current ? 'true' : 'false');
            });
            if (announce && announcement) {
                announcement.textContent = 'Destaque ' + (index + 1) + ' de ' + slides.length;
            }
        }

        function stop() {
            if (timer !== null) {
                window.clearInterval(timer);
                timer = null;
            }
        }

        function schedule() {
            stop();
            if (isPaused()) return;
            timer = window.setInterval(function () {
                render(index + 1, false);
            }, INTERVAL);
        }

        function navigate(nextIndex) {
            render(nextIndex, true);
            schedule();
        }

        function syncPauseLabel() {
            if (!pause) return;
            pause.setAttribute('aria-pressed', String(manuallyPaused));
            pause.textContent = manuallyPaused ? '▶' : 'Ⅱ';
            pause.setAttribute('aria-label', manuallyPaused ? 'Retomar transição automática' : 'Pausar transição automática');
            pause.title = manuallyPaused ? 'Retomar animação' : 'Pausar animação';
        }

        if (previous) previous.addEventListener('click', function () { navigate(index - 1); });
        if (next) next.addEventListener('click', function () { navigate(index + 1); });
        dots.forEach(function (dot, dotIndex) {
            dot.addEventListener('click', function () { navigate(dotIndex); });
        });
        if (pause) {
            pause.addEventListener('click', function () {
                manuallyPaused = !manuallyPaused;
                syncPauseLabel();
                schedule();
            });
        }

        // Não pausar somente porque o mouse está sobre o slide.
        // Para interromper a troca, o visitante utiliza o botão Pausar.
        slider.addEventListener('keydown', function (event) {
            if (event.target.closest('input, textarea, select')) return;
            if (event.key === 'ArrowLeft') { event.preventDefault(); navigate(index - 1); }
            if (event.key === 'ArrowRight') { event.preventDefault(); navigate(index + 1); }
        });

        document.addEventListener('visibilitychange', schedule);
        if (reduceMotion.addEventListener) reduceMotion.addEventListener('change', schedule);
        // Toque lateral no celular: o gesto não interfere no scroll vertical.
        let startX = 0;
        let startY = 0;
        slider.addEventListener('touchstart', function (event) {
            if (!event.touches.length) return;
            startX = event.touches[0].clientX;
            startY = event.touches[0].clientY;
        }, { passive: true });
        slider.addEventListener('touchend', function (event) {
            if (!event.changedTouches.length) return;
            const dx = event.changedTouches[0].clientX - startX;
            const dy = event.changedTouches[0].clientY - startY;
            if (Math.abs(dx) >= 55 && Math.abs(dx) > Math.abs(dy) * 1.5) {
                navigate(index + (dx < 0 ? 1 : -1));
            }
        }, { passive: true });

        render(0, false);
        syncPauseLabel();
        schedule();
    });
});
