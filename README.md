# Tema WordPress — EEEP Professor Antonio Valmir da Silva

Tema institucional, responsivo e acessível (padrão eMAG / WCAG) desenvolvido para a EEEP Professor Antonio Valmir da Silva.

## 🚀 Funcionalidades
- **Recursos de Acessibilidade**: Aumento/diminuição de fonte (`A+`, `A-`, `A`) e modo de **Alto Contraste** persistente via `localStorage`.
- **Atalhos e Editais Locais**: Acesso direto a documentos em PDF hospedados no próprio servidor (`/pdf/edital-2026.pdf` e `/pdf/resultado-2025.pdf`).
- **Grade de Cursos Técnicos**: Mapeamento e exibição dos 5 cursos da instituição (*Administração*, *Edificações*, *Eletromecânica*, *Logística* e *Informática*).
- **Esquema de Cores Institucional**: Paleta baseada nas cores do Ceará/Brasil (Verde, Azul e Amarelo).

## 📁 Estrutura de Arquivos
- `header.php` — Cabeçalho com navegação e barra superior de acessibilidade.
- `footer.php` — Rodapé e scripts JS de acessibilidade.
- `front-page.php` — Modelo da página inicial.
- `single-curso.php` — Modelo individual dos cursos técnicos.
- `style.css` — Estilos globais e regras do modo alto contraste.
- `functions.php` — Configurações do tema e enfileiramento de recursos.
- `pdf/` — Diretório interno para hospedagem local dos editais.
