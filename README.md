# 🏫 Tema WordPress Institucional e Acessível para EEEPs

Tema WordPress leve, responsivo e adaptado às normas de acessibilidade (**eMAG / WCAG**), desenvolvido originalmente para a **EEEP Professor Antonio Valmir da Silva** e preparado para fácil reuso em outras instituições de ensino.

---

## 🚀 Funcionalidades Principais
- **Acessibilidade Completa**: Ajuste dinâmico de tamanho de fonte (`A+`, `A-`, `A`) e modo de **Alto Contraste** com persistência no navegador via `localStorage`.
- **Menu Mobile Responsivo**: Navegação adaptada com botão hambúrguer para dispositivos móveis (smartphones e tablets).
- **Hospedagem Local de Editais (PDF)**: Links diretos para documentos em `/pdf/edital-2026.pdf` e `/pdf/resultado-2025.pdf`, sem dependência de plataformas externas.
- **Grade de Cursos Técnicos**: Estrutura pronta para os 5 cursos técnicos (*Administração*, *Edificações*, *Eletromecânica*, *Logística* e *Informática*).
- **Cores Institucionais Customizáveis**: Paleta configurada por variáveis CSS globais.

---

## 🛠️ Como adaptar este tema para a sua escola

Se você é gestor ou desenvolvedor de outra escola e deseja usar este tema:

### 1. Alterar Cores no `style.css`
```css
:root {
    --verde-brasil: #008736;
    --azul-brasil: #002776;
    --amarelo-brasil: #ffdf00;
}
