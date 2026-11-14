/* Navegação e leitura acessível do portal EEEP. Sem JavaScript inline. */
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const storage = {
        get(key) {
            try { return window.localStorage.getItem(key); } catch (error) { return null; }
        },
        set(key, value) {
            try { window.localStorage.setItem(key, String(value)); } catch (error) { /* opcional */ }
        },
        remove(key) {
            try { window.localStorage.removeItem(key); } catch (error) { /* opcional */ }
        }
    };

    const buttonPlus = document.getElementById('btn-aumentar-fonte');
    const buttonMinus = document.getElementById('btn-diminuir-fonte');
    const buttonReset = document.getElementById('btn-reset-fonte');
    const buttonContrast = document.getElementById('btn-alto-contraste');

    let fontSize = Number.parseInt(storage.get('eeep_font_zoom'), 10);
    if (!Number.isFinite(fontSize)) fontSize = 100;
    fontSize = Math.max(80, Math.min(150, fontSize));

    function applyFontSize(value) {
        fontSize = Math.max(80, Math.min(150, value));
        document.documentElement.style.fontSize = fontSize + '%';
        storage.set('eeep_font_zoom', fontSize);
        if (buttonMinus) buttonMinus.disabled = fontSize <= 80;
        if (buttonPlus) buttonPlus.disabled = fontSize >= 150;
    }

    applyFontSize(fontSize);
    if (buttonPlus) buttonPlus.addEventListener('click', () => applyFontSize(fontSize + 10));
    if (buttonMinus) buttonMinus.addEventListener('click', () => applyFontSize(fontSize - 10));
    if (buttonReset) buttonReset.addEventListener('click', () => {
        applyFontSize(100);
        storage.remove('eeep_font_zoom');
    });

    function applyContrast(enabled) {
        document.body.classList.toggle('alto-contraste', enabled);
        if (buttonContrast) {
            buttonContrast.setAttribute('aria-pressed', String(enabled));
            buttonContrast.setAttribute('aria-label', enabled ? 'Desativar alto contraste' : 'Ativar alto contraste');
        }
        storage.set('eeep_alto_contraste', enabled ? 'ativado' : 'desativado');
    }

    const oldContrastValue = storage.get('eeep_alto_contraste');
    applyContrast(oldContrastValue === 'true' || oldContrastValue === 'ativado');
    if (buttonContrast) {
        buttonContrast.addEventListener('click', () => {
            applyContrast(!document.body.classList.contains('alto-contraste'));
        });
    }

    const toggle = document.querySelector('.menu-toggle');
    const menu = document.getElementById('primary-menu');
    const nav = document.querySelector('.main-navigation');
    if (!toggle || !menu || !nav) return;

    function closeMenu() {
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Abrir menu de navegação');
        toggle.classList.remove('is-active');
        menu.classList.remove('is-active');
        menu.querySelectorAll('.submenu-toggle').forEach(button => {
            button.setAttribute('aria-expanded', 'false');
            button.parentElement.classList.remove('submenu-open');
        });
    }

    toggle.addEventListener('click', () => {
        const open = toggle.getAttribute('aria-expanded') !== 'true';
        if (!open) {
            closeMenu();
        } else {
            menu.classList.add('is-active');
            toggle.classList.add('is-active');
            toggle.setAttribute('aria-expanded', 'true');
            toggle.setAttribute('aria-label', 'Fechar menu de navegação');
        }
    });

    // Submenus acessíveis em telas pequenas. Links dos itens-pai continuam navegáveis.
    menu.querySelectorAll('li').forEach((item, index) => {
        const submenu = Array.from(item.children).find(el => el.tagName === 'UL');
        const parentLink = Array.from(item.children).find(el => el.tagName === 'A');
        if (!submenu || !parentLink) return;
        item.classList.add('menu-item-has-children');
        submenu.classList.add('sub-menu');
        submenu.id = submenu.id || 'eeep-submenu-' + index;

        const submenuButton = document.createElement('button');
        submenuButton.type = 'button';
        submenuButton.className = 'submenu-toggle';
        submenuButton.setAttribute('aria-expanded', 'false');
        submenuButton.setAttribute('aria-controls', submenu.id);
        submenuButton.setAttribute('aria-label', 'Expandir submenu de ' + parentLink.textContent.trim());
        submenuButton.textContent = '⌄';
        parentLink.insertAdjacentElement('afterend', submenuButton);

        submenuButton.addEventListener('click', () => {
            const open = submenuButton.getAttribute('aria-expanded') !== 'true';
            item.classList.toggle('submenu-open', open);
            submenuButton.setAttribute('aria-expanded', String(open));
            submenuButton.setAttribute('aria-label', (open ? 'Recolher' : 'Expandir') + ' submenu de ' + parentLink.textContent.trim());
        });
    });

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
            closeMenu();
            toggle.focus();
        }
    });

    document.addEventListener('click', event => {
        if (!nav.contains(event.target)) closeMenu();
    });

    menu.addEventListener('click', event => {
        if (event.target.closest('a') && window.matchMedia('(max-width: 960px)').matches) {
            closeMenu();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 960) closeMenu();
    });
});
