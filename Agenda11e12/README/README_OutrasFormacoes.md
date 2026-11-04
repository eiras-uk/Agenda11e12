# Módulo Outras Formações - Sistema de Currículos (Enlatados Juarez)

## Descrição
Este módulo gerencia o cadastro, listagem e exclusão de cursos e formações complementares (Outras Formações) dos usuários no portal de currículos, utilizando o padrão arquitetural MVC (Model-View-Controller).

## Arquitetura e Componentes
- **Model**: `OutrasFormacoes.php` — Responsável pela estrutura de dados e comunicação direta com a base de dados MySQL.
- **Controller**: `OutrasFormacoesController.php` — Contém a lógica de negócio para inserir, remover e gerar a lista de registros do usuário.
- **Front Controller (Rotas)**: `Navegacao.php` — Intercepta as requisições POST e direciona para os métodos correspondentes do Controller.
- **View**: Integrado na página principal (`principal.php`), exibindo o formulário de cadastro e a tabela dinâmica de registros.

## Rotas e Parâmetros
O fluxo de navegação gerencia as seguintes ações via método `POST`:

1. **Adicionar Formação**
   - **Trigger / Botão**: `btnAddOF`
   - **Parâmetros enviados**: 
     - `txtInicioOF` (Data de início)
     - `txtFimOF` (Data de término)
     - `txtDescOF` (Descrição da formação)
   - **Retorno**: Redirecionamento para a tela de confirmação (`informacaoInserida.php` ou `operacaoNaoRealizada.php`).

2. **Excluir Formação**
   - **Trigger / Botão**: `btnExcluirOF`
   - **Parâmetros enviados**: 
     - `idOF` (Identificador único do registro a ser removido)
   - **Retorno**: Redirecionamento para a tela de confirmação de exclusão.

3. **Gerar Lista**
   - **Método**: `gerarLista($idUsuario)`
   - **Parâmetro**: ID do usuário logado armazenado na sessão.
   - **Retorno**: Objeto contendo os registros de outras formações para exibição em tabela dinâmica na View.

## Mensagens de Retorno Comuns
- Sucesso ao inserir/remover: Exibe a view de confirmação positiva.
- Falha na operação: Redireciona para `operacaoNaoRealizada.php` em caso de falha de conexão ou erro de execução SQL.

## Dependências
- PHP 8.x
- Banco de dados MySQL (via XAMPP)
- Framework CSS W3.CSS e biblioteca Font Awesome para ícones visuais.