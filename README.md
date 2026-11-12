# Tema EEEP — WordPress institucional

Tema clássico para WordPress, com cursos técnicos, notícias, navegação responsiva e recursos básicos de acessibilidade.

## Versão 1.2.0 — correções do cabeçalho e conteúdos

- Menu principal **dinâmico**, gerenciado no WordPress por uma localização de menu.
- Submenus com suporte a teclado, mouse e botão de expansão no celular.
- Logo personalizável e nome da escola obtido das configurações do site.
- A+, A−, restaurar fonte e alto contraste funcionais e persistidos no navegador.
- JavaScript enfileirado pelo WordPress; CSS deixa de ser carregado duas vezes.
- Cursos na página inicial, nas páginas de detalhes, no arquivo e na página 404 vêm dos posts do tipo **Curso**, sem links duplicados escritos no template.
- Layout de páginas internas, páginas comuns e arquivo de notícias aprimorado.
- Os arquivos de edital e resultado continuam no diretório \`pdf/\` como exemplos. **Substitua documentos antigos e confirme a validade das informações antes de publicar.**

## Instalação / atualização com segurança

1. Faça backup dos arquivos do tema em \`wp-content/themes/\` e do banco de dados.
2. Baixe a versão corrigida da branch \`correcao-menu-header-dinamico\` no GitHub ou mescle o pull request após a revisão.
3. Faça a instalação em ambiente de teste antes de substituir a versão em produção.
4. Se ativou uma cópia do tema com nome de pasta diferente, os menus e algumas preferências do tema precisam ser reatribuídos.
5. No painel WordPress, acesse **Aparência → Menus**. Crie ou selecione o menu, adicione links/páginas e marque **Menu principal (cabeçalho)** na localização de exibição. Salve.
6. Em **Aparência → Personalizar → Identidade do site**, defina o logotipo. Em **Configurações → Geral**, confira o título do site. A posição exata dessas opções pode variar com a versão do WordPress.
7. Em **Cursos Técnicos**, edite títulos, resumos e conteúdos. A página inicial será atualizada com os cursos publicados.
8. Se as páginas de cursos retornarem 404, entre em **Configurações → Links permanentes** e clique **Salvar alterações** para atualizar as regras de URL.
9. Teste o menu no celular e no computador, os submenus, a navegação por Tab/Escape, o modo alto contraste e os PDFs.

### WordPress Multisite

Cada site da rede mantém sua própria atribuição de menu, identidade, cursos e conteúdos. Ativar o tema em um subsite não configura automaticamente os menus de outros subsites.

### Sem menu atribuído

O tema ainda apresenta os links padrão de Início, Cursos, Edital, Resultado e YouTube **até** um administrador atribuir um menu ao cabeçalho. Depois, os links exibidos são os que estiverem no menu cadastrado.

## Arquivos principais

- \`header.php\`: cabeçalho, logo e menu dinâmico.
- \`functions.php\`: suporte ao tema, recursos e registro dos cursos.
- \`acessibilidade.js\`: menu móvel, submenus, zoom e alto contraste.
- \`front-page.php\`: página inicial e consulta dos cursos.
- \`single-curso.php\`, \`archive-curso.php\`: detalhes e lista de cursos.
- \`page.php\`, \`index.php\`, \`404.php\`: páginas e listagens.
- \`style.css\`: identidade visual, navegação e conteúdos internos.

## Limites de validação

A revisão foi realizada sobre os arquivos do repositório. É necessário conferir o funcionamento em uma instalação real do WordPress, inclusive com os plugins, menus e dados da escola. Recursos de acessibilidade ajudam a navegação, mas **não equivalem, isoladamente, a uma certificação WCAG/eMAG**.

## Observação sobre o arquivo \`cd\`

O repositório contém um arquivo chamado \`cd\` com código de um plugin de manutenção de rede. Ele **não é carregado automaticamente como parte do tema**. Avalie sua separação em um plugin próprio, depois de revisar o uso desse recurso no Multisite.
