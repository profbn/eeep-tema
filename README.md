# Tema EEEP — WordPress institucional

Tema clássico para WordPress, com cursos técnicos, notícias, navegação responsiva e recursos básicos de acessibilidade.

## Base da versão 1.2.0 — correções do cabeçalho e conteúdos

- Menu principal **dinâmico**, gerenciado no WordPress por uma localização de menu.
- Submenus com suporte a teclado, mouse e botão de expansão no celular.
- Logo personalizável e nome da escola obtido das configurações do site.
- A+, A−, restaurar fonte e alto contraste funcionais e persistidos no navegador.
- JavaScript enfileirado pelo WordPress; CSS deixa de ser carregado duas vezes.
- Cursos na página inicial, nas páginas de detalhes, no arquivo e na página 404 vêm dos posts do tipo **Curso**, sem links duplicados escritos no template.
- Layout de páginas internas, páginas comuns e arquivo de notícias aprimorado.
- Os arquivos de edital e resultado continuam no diretório `pdf/` como exemplos. **Substitua documentos antigos e confirme a validade das informações antes de publicar.**


## Novidade — Portal EEEP 2026 (tema 2.0)

- Layout editorial de largura ampla: conteúdo dos artigos ocupa a área útil da tela com barra lateral de assuntos, subcategorias e notícias recentes, eliminando as margens laterais excessivas.
- Carrossel de até cinco **posts recentes** imediatamente abaixo do menu, em todas as páginas. Usa imagem destacada do post; quando ela não existe, tenta uma imagem do conteúdo ou a miniatura de vídeo do YouTube. Se não houver imagem, usa fundo gráfico.
- Transições suaves a cada **5 segundos**, com setas, pontos, controle de pausa, gestos laterais e teclado. O carrossel **não pausa apenas porque o mouse está sobre ele**. Para respeitar acessibilidade, o botão de pausa continua disponível, a rotação é suspensa quando a aba está oculta e não se inicia automaticamente se o dispositivo solicita menos movimento.
- Categorias e subcategorias hierárquicas no menu principal com item **Categorias**, criado automaticamente a partir do cadastro do WordPress. Não é necessário alterar o código para incluir novos assuntos.
- Página própria de categorias com listagem de posts, imagem, descrição e links para subcategorias.
- Publicações e arquivos em grade responsiva, com imagens ou miniaturas de vídeo.
- Paleta institucional verde com tons neutros, fontes legíveis, foco acessível e maior aproveitamento do espaço.

### Como criar as categorias e subcategorias

1. No painel WordPress acesse **Posts → Categorias**.
2. Cadastre uma categoria, por exemplo **Tecnologia**.
3. Cadastre **Redes de Computadores**; em **Categoria ascendente / Categoria mãe**, escolha **Tecnologia**.
4. Cadastre **IPv6**; em **Categoria ascendente**, escolha **Redes de Computadores**.
5. Abra **Posts → Adicionar novo** (ou edite uma publicação). Na barra lateral de configurações do post, marque a categoria desejada.
6. Se **Categorias** não aparecer no editor de blocos, confira **Preferências → Painéis** no menu de três pontos e ative o painel **Categorias**. No editor clássico, confira **Opções de tela**.
7. O item **Categorias** surgirá automaticamente no cabeçalho quando houver pelo menos uma categoria diferente da categoria padrão **Sem categoria**. Subcategorias são exibidas como submenus.

### Ajustar a ordem do menu de categorias (opcional)

Em **Aparência → Menus**, crie um menu chamado **Assuntos do Portal**. Na caixa **Categorias**, selecione as categorias desejadas, adicione ao menu e arraste subcategorias ligeiramente para a direita sob a categoria mãe. Atribua-o à localização **Categorias e subcategorias (opcional)** e salve. Se a caixa **Categorias** não aparecer na tela de Menus, habilite-a em **Opções de tela**. Quando esse menu opcional estiver atribuído, ele substitui a lista automática mantendo o item **Categorias** no cabeçalho.

**Atenção:** Posts normais do WordPress têm categorias nativas. O tipo de conteúdo **Cursos Técnicos** é separado e não usa essas categorias para não misturar cursos com matérias escolares.

### Diagnóstico se o carrossel não trocar os posts

1. Confirme pelo menos **2 posts publicados**; para exibir cinco diferentes, são necessários pelo menos **5 posts publicados**.
2. O carrossel consulta automaticamente **os cinco posts mais recentes**, em ordem de data. Não utiliza páginas ou o tipo personalizado **Cursos**.
3. Confirme que instalou a **branch correcao-menu-header-dinamico (versão 2.0.1)**, e não o tema antigo da branch \`main\`.
4. Atualize a página com **Ctrl + Shift + R** e limpe cache do site/CDN ou plugins de otimização, se houver.
5. Se o dispositivo estiver configurado para **reduzir animações**, o carrossel respeita essa preferência e não avança automaticamente; as setas e os indicadores continuam disponíveis.
6. O arquivo \`assets/js/portal-slider.js\` deve carregar sem erro (verifique a aba **Rede/Network** e o **Console** do navegador).

### Boas práticas para o carrossel

- Adicione **Imagem destacada** em cada post para melhor definição de imagem.
- Recomendação: fotografias em proporção **16:9** (por exemplo 1600 × 900 pixels).
- Escreva títulos curtos e resumos objetivos: eles aparecerão no slide.
- O carrossel usa os posts publicados mais recentes, sem editar um conjunto fixo de links.

## Instalação / atualização com segurança

1. Faça backup dos arquivos do tema em `wp-content/themes/` e do banco de dados.
2. Baixe a versão corrigida da branch `correcao-menu-header-dinamico` no GitHub ou mescle o pull request após a revisão.
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

- `header.php`: cabeçalho, logo e menu dinâmico.
- `functions.php`: suporte ao tema, recursos e registro dos cursos.
- `acessibilidade.js`: menu móvel, submenus, zoom e alto contraste.
- `front-page.php`: página inicial e consulta dos cursos.
- `single-curso.php`, `archive-curso.php`: detalhes e lista de cursos.
- `page.php`, `index.php`, `404.php`: páginas e listagens.
- `style.css`: identidade visual, navegação e conteúdos internos.

## Limites de validação

A revisão foi realizada sobre os arquivos do repositório. É necessário conferir o funcionamento em uma instalação real do WordPress, inclusive com os plugins, menus e dados da escola. Recursos de acessibilidade ajudam a navegação, mas **não equivalem, isoladamente, a uma certificação WCAG/eMAG**.

## Observação sobre o arquivo `cd`

O repositório contém um arquivo chamado `cd` com código de um plugin de manutenção de rede. Ele **não é carregado automaticamente como parte do tema**. Avalie sua separação em um plugin próprio, depois de revisar o uso desse recurso no Multisite.
