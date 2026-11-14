/* Seleção de PDFs diretamente da Biblioteca de Mídia do WordPress. */
(function ($) {
    'use strict';
    $(function () {
        const input = $('#eeep_documento_pdf');
        if (!input.length) return;

        $('[data-eeep-selecionar-pdf]').on('click', function (event) {
            event.preventDefault();
            if (!window.wp || !window.wp.media) return;
            const media = wp.media({
                title: 'Selecionar edital ou resultado em PDF',
                button: { text: 'Usar este PDF' },
                library: { type: 'application/pdf' },
                multiple: false
            });
            media.on('select', function () {
                const attachment = media.state().get('selection').first();
                if (!attachment) return;
                const document = attachment.toJSON();
                if (document.mime !== 'application/pdf' || !document.url) return;
                input.val(document.url).trigger('change');
            });
            media.open();
        });

        $('[data-eeep-limpar-pdf]').on('click', function (event) {
            event.preventDefault();
            input.val('').trigger('change');
        });
    });
})(jQuery);
