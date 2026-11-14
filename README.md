# EEEP Tema 2.2.1 — organização da página inicial e novo slide de notícias

A página inicial segue esta ordem:
1. **Logo abaixo do menu principal:** Nossa escola, Editais, Resultados, YouTube e Instagram.
2. **Carrossel dos cinco cursos técnicos:** transição automática de 5 em 5 segundos.
3. **Conteúdos interativos por curso:** cinco áreas dinâmicas.
4. **Portal de notícias e informações:** novo carrossel editorial, com imagem à esquerda e texto legível à direita, versão para celular, setas e indicadores. Busca os cinco posts mais recentes e também avança a cada 5 segundos.

Os cartões de Editais e Resultados continuam dinâmicos, com consulta ao ano mais recente. O restante das páginas internas e cadastros foi mantido.

O ZIP instalável da versão 2.2.1 continua usando exclusivamente a pasta principal `eeep-tema/`. Use o arquivo do Release, não o Download ZIP da branch. A troca de tema exige backup e teste no WordPress, especialmente se o banco ainda apontar para o antigo diretório duplicado.

---

# EEEP Tema 2.2.0 — Editais e Resultados dinâmicos

**Mudança principal:** Editais e Resultados não ficam mais vinculados a PDFs fixos no código. São cadastrados e publicados pelo painel do WordPress, com ano, título, descrição e arquivo PDF; novos anos aparecem automaticamente, sem apagar os anteriores.

## Como adicionar um novo edital

1. Entre no WordPress e abra **Editais → Adicionar novo**.
2. Escreva o título, por exemplo: **Edital de inscrições — 2027** (apenas exemplo de nomenclatura, não um edital real).
3. Em **Ano e documento oficial**, indique o ano do processo seletivo e use **Selecionar PDF na Biblioteca de Mídia** para escolher o documento verdadeiro. Alternativamente, cole o link HTTPS do PDF.
4. Escreva a descrição ou informações de inscrição no editor. Verifique a versão oficial antes de publicar.
5. Clique **Publicar**. A página **/editais/** já exibe o novo edital e mantém todos os anos anteriores, com filtro de ano. A home passa a mostrar automaticamente o edital mais recente pelo ano cadastrado.

## Como adicionar um novo resultado

1. Abra **Resultados → Adicionar novo**.
2. Insira título e descrição, informe o **ano do processo seletivo** e escolha o PDF do resultado oficial.
3. Clique **Publicar**. A página **/resultados/** mostra o documento sem alterar arquivos do tema; o cartão da home passa a apontar para o acervo atualizado.
4. Se houver mais de uma chamada ou retificação no mesmo ano, crie outra publicação: o sistema mantém todas.

**Importante:** arquivos permanecem no banco e na Biblioteca de Mídia do WordPress, não dentro da pasta do tema. Uma atualização do ZIP não apaga os documentos cadastrados. Faça backup do banco de dados e de \`wp-content/uploads/\` antes de migrar.

## Ordem atual da página inicial

1. Carrossel dos **cinco cursos técnicos** (avança a cada **5 segundos**).
2. **Conteúdos interativos por curso**.
3. **Nossa escola**, com link para a página institucional.
4. Quatro atalhos: **Editais**, **Resultados**, **Canal no YouTube** e **Instagram** da escola.
5. Carrossel das **cinco publicações recentes**.

As áreas de cursos, documentos e posts são alimentadas pelo WordPress, e não por arquivos PDF definidos no tema. Os PDFs antigos armazenados no repositório não são incluídos no novo ZIP por serem referências históricas não verificadas para publicação atual.

## Configuração dos links no menu

No painel **Aparência → Menus**, adicione os arquivos **Editais** e **Resultados** ao seu menu principal, usando os endereços \`/editais/\` e \`/resultados/\`. Se o menu não estiver configurado, o menu padrão do tema já inclui os dois links. Em **Configurações → Links permanentes**, clique **Salvar alterações** uma vez se receber erro 404 nos endereços.

## Atualização do WordPress

Use o arquivo \`eeep-tema.zip\` do release **v2.2.0**, que tem **uma única pasta \`eeep-tema/\`**. Não extraia a pasta do tema dentro de outra pasta \`eeep-tema/\`. Em WordPress Multisite, os documentos cadastrados são específicos de cada site da rede.

## Validação

Verificações automáticas: sintaxe PHP, JavaScript e integridade estrutural do ZIP. Testes funcionais e visuais no WordPress da escola continuam necessários. Nenhum edital ou resultado fictício é criado automaticamente, pois documentos oficiais precisam ser conferidos antes da publicação.

---

# EEEP Tema 2.1.1 — requisitos institucionais 2026 (versão anterior)

Esta versão evolui o **tema existente** conforme o *Documento de Especificação de Requisitos e Melhorias do Site Institucional da Escola* (Caucaia, 2026). Não inventa históricos, logotipos, docentes ou currículos.

## Página inicial simplificada — versão 2.1.1

A página inicial apresenta somente estas áreas, nesta ordem:
1. **Conteúdos interativos por curso**, imediatamente abaixo do menu, com os cinco cursos.
2. **Carrossel dos cinco cursos técnicos**, automático a cada 5 segundos, com controles acessíveis.
3. **Carrossel das cinco publicações mais recentes**, também automático a cada 5 segundos.

Foram retiradas **da home** as caixas repetitivas de apresentação “Sobre a escola”, Edital, Resultado, YouTube, a grade de cartões que repetia os cursos do slide e a lista de notícias que repetia o carrossel de posts. Isso **não exclui** as páginas institucionais, arquivos de edital ou posts existentes. O acesso à página “Sobre a escola” e aos demais links pode continuar pelo menu do WordPress.

## Requisitos implementados

| Requisito | Situação | Onde configurar |
|---|---|---|
| RF-01 Logomarca oficial | Suporte a logo oficial; upload pendente | Aparência → Personalizar → Identidade do site |
| RF-02 a RF-04 Sobre, história e origem do nome | Página criada com campos de texto editáveis e avisos de validação | Páginas → Sobre a escola |
| RF-05 Docentes | Opcional, não cadastrado sem autorização | Página Sobre a escola |
| RF-06/07 Conteúdos interativos nos cinco cursos | Página por curso, com materiais associados a Posts | Posts → Curso relacionado |
| RF-08/09 Páginas dos cinco cursos | Mantidas, com descrições, objetivos e áreas | Cursos Técnicos → Editar |
| RF-10 Grade curricular | Três campos por ano, um componente por linha, e PDF opcional | Cursos Técnicos → Informações oficiais e grade curricular |
| RF-11 Informações para candidatos | Seção padrão com dados editáveis do curso | Cursos Técnicos → Editar |
| RF-12 Edital | Link exibido somente quando cadastrado e conferido | Cursos Técnicos → Link do edital oficial |
| RNF-01 a RNF-08 | Estrutura responsiva, legível, consistente e acessível | Verificação final no WordPress necessário |

### Carrosséis

- **Abaixo do menu da página inicial:** carrossel dedicado aos **cinco cursos técnicos**, transição automática de **5 em 5 segundos**, setas, indicadores e pausa.
- **Mais abaixo na página inicial:** carrossel das **cinco publicações mais recentes**, também a cada 5 segundos. Assim as notícias continuam disponíveis sem substituir o destaque dos cursos.
- O movimento automático é desligado se o sistema do visitante solicita movimento reduzido; os controles manuais continuam disponíveis.
- Foto de cada slide de curso: edite o curso e selecione **Imagem destacada**. Sem foto, aparece fundo gráfico, não uma imagem inventada.

### Preparar conteúdos de cada curso

1. Em **Cursos Técnicos**, abra cada um dos cinco cursos.
2. Revise o texto da apresentação e as descrições que já existiam no banco de dados. Textos antigos não são apagados automaticamente para preservar seu trabalho.
3. Preencha objetivos, áreas de estudo, duração, carga horária e modalidade somente com dados confirmados.
4. No painel **Informações oficiais e grade curricular**, informe as disciplinas separadas por linhas para o **1º**, **2º** e **3º ano**.
5. Opcionalmente, informe o PDF da grade curricular e o link do edital oficial aplicável.
6. Salve o curso e verifique o resultado na página pública.

### Associar atividades aos cursos

1. No WordPress, abra **Posts → Adicionar novo**.
2. Cadastre uma atividade, vídeo, material ou conteúdo relacionado.
3. No painel lateral **Curso relacionado**, marque uma das cinco áreas: Administração, Edificações, Eletromecânica, Logística ou Informática.
4. Publique o post. Ele aparecerá na listagem de conteúdos correspondente.
5. O painel de **Categorias** continua disponível separadamente para matérias/subcategorias, como Informática → Redes → IPv6.
6. Acesse **Páginas → Conteúdos interativos** para visualizar os cinco cursos. Mesmo sem material publicado, a área de cada curso continua visível.

### Seção institucional e logomarca

- Visite **Páginas → Sobre a escola** e substitua os avisos provisórios pela história oficial da instituição e pela explicação validada da origem de seu nome.
- Professores só devem ser publicados com confirmação e autorização institucional.
- Envie a logomarca **oficial** em **Identidade do site**. Até esse passo, o cabeçalho exibe uma sigla textual EEEP e não utiliza uma imagem gerada por IA como se fosse a oficial.

### Instalação sem pastas duplicadas

O pacote oficial do release é **eeep-tema.zip**. Ele deve conter apenas uma pasta raiz \`eeep-tema/\`, com \`style.css\` e \`functions.php\` diretamente dentro dela. Não descompacte dentro de uma pasta \`eeep-tema\` preexistente.

**Atenção ao erro anterior do Docker:** se o banco ainda estiver referenciando \`eeep-tema/eeep-tema-correcao-menu-header-dinamico\`, reinstalar o ZIP sozinho não corrigirá o valor da opção \`stylesheet\`. Corrija a ativação do tema com backup e no site correto do WordPress / Multisite.

## Limitações / validação pendente

O documento fornecido não inclui a logomarca oficial, a história confirmada, as grades curriculares, o cadastro autorizado de docentes nem editais atualizados. A implementação deixa locais apropriados para publicá-los, mas esses critérios somente estarão integralmente atendidos após revisão por representantes da escola.

Os testes automáticos verificam sintaxe PHP e JavaScript e integridade do pacote ZIP. A navegação no WordPress real, o desempenho, a responsividade em dispositivos e a acessibilidade devem ser testados antes da publicação.

---

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
