<?php
if (!isset($_SESSION)) {
    session_start();
}

switch (true) {
    // Se nenhum POST foi enviado, mostra o login
    case empty($_POST):
        include_once __DIR__ . '/../View/login.php';
        break;

    // -- Primeiro Acesso -- //
    case isset($_POST["btnPrimeiroAcesso"]):
        include_once __DIR__ . '/../View/PrimeiroAcesso.php';
        break;

    // -- Cadastrar Usuário -- //
    case isset($_POST["btnCadastrar"]):
        require_once __DIR__ . '/UsuarioController.php';
        $uController = new UsuarioController();
        if ($uController->inserir(
            $_POST["txtNome"],
            $_POST["txtCPF"],
            $_POST["txtEmail"],
            $_POST["txtSenha"]
        )) {
            include_once __DIR__ . '/../View/CadastroRealizado.php';
        } else {
            include_once __DIR__ . '/../View/CadastroNaoRealizado.php';
        }
        break;

    // -- Login -- //
    case isset($_POST["btnLogin"]):
        require_once __DIR__ . '/UsuarioController.php';
        $uController = new UsuarioController();
        if ($uController->login($_POST["txtLogin"], $_POST["txtSenha"])) {
            include_once __DIR__ . '/../View/Principal.php';
        } else {
            include_once __DIR__ . '/../View/CadastroNaoRealizado.php';
        }
        break;

    // -- Atualizar Dados Pessoais -- //
    case isset($_POST["btnAtualizar"]):
        require_once __DIR__ . '/UsuarioController.php';
        $uController = new UsuarioController();
        if ($uController->atualizar(
            $_POST["txtID"],
            $_POST["txtNome"],
            $_POST["txtCPF"],
            $_POST["txtEmail"],
            date("Y-m-d", strtotime($_POST["txtData"]))
        )) {
            include_once __DIR__ . '/../View/AtualizacaoRealizada.php';
        } else {
            include_once __DIR__ . '/../View/OperacaoNaoRealizada.php';
        }
        break;

    // -- Adicionar Formação Acadêmica -- //
    case isset($_POST["btnAddFormacao"]):
        require_once __DIR__ . '/FormacaoAcadController.php';
        include_once __DIR__ . '/../Model/Usuario.php';
        $fController = new FormacaoAcadController();
        if ($fController->inserir(
            date("Y-m-d", strtotime($_POST["txtInicioFA"])),
            date("Y-m-d", strtotime($_POST["txtFimFA"])),
            $_POST["txtDescFA"],
            unserialize($_SESSION["Usuario"])->getID()
        ) != false) {
            include_once __DIR__ . '/../View/InformacaoInserida.php';
        } else {
            include_once __DIR__ . '/../View/OperacaoNaoRealizada.php';
        }
        break;

    // -- Excluir Formação Acadêmica -- //
    case isset($_POST["btnExcluirFA"]):
        require_once __DIR__ . '/FormacaoAcadController.php';
        include_once __DIR__ . '/../Model/Usuario.php';
        $fController = new FormacaoAcadController();
        if ($fController->remover($_POST["id"]) == true) {
            include_once __DIR__ . '/../View/InformacaoExcluida.php';
        } else {
            include_once __DIR__ . '/../View/OperacaoNaoRealizada.php';
        }
        break;

    // -- Adicionar Experiência Profissional -- //
    case isset($_POST["btnAddEP"]):
        require_once __DIR__ . '/ExperienciaProfissionalController.php';
        include_once __DIR__ . '/../Model/Usuario.php';
        $epController = new ExperienciaProfissionalController();
        if ($epController->inserir(
            date("Y-m-d", strtotime($_POST["txtInicioEP"])),
            date("Y-m-d", strtotime($_POST["txtFimEP"])),
            $_POST["txtEmpEP"],
            $_POST["txtDescEP"],
            unserialize($_SESSION["Usuario"])->getID()
        ) != false) {
            include_once __DIR__ . '/../View/InformacaoInserida.php';
        } else {
            include_once __DIR__ . '/../View/OperacaoNaoRealizada.php';
        }
        break;

    // -- Excluir Experiência Profissional -- //
    case isset($_POST["btnExcluirEP"]):
        require_once __DIR__ . '/ExperienciaProfissionalController.php';
        include_once __DIR__ . '/../Model/Usuario.php';
        $epController = new ExperienciaProfissionalController();
        if ($epController->remover($_POST["idEP"]) == true) {
            include_once __DIR__ . '/../View/InformacaoExcluida.php';
        } else {
            include_once __DIR__ . '/../View/OperacaoNaoRealizada.php';
        }
        break;

    // -- Adicionar Outras Formações (Agenda 13) -- //
    case isset($_POST["btnAddOF"]):
        require_once __DIR__ . '/OutrasFormacoesController.php';
        include_once __DIR__ . '/../Model/Usuario.php';
        $ofController = new OutrasFormacoesController();
        if ($ofController->inserir(
            date("Y-m-d", strtotime($_POST["txtInicioOF"])),
            date("Y-m-d", strtotime($_POST["txtFimOF"])),
            $_POST["txtDescOF"],
            unserialize($_SESSION["Usuario"])->getID()
        ) != false) {
            include_once __DIR__ . '/../View/InformacaoInserida.php';
        } else {
            include_once __DIR__ . '/../View/OperacaoNaoRealizada.php';
        }
        break;

    // -- Excluir Outras Formações (Agenda 13) -- //
    case isset($_POST["btnExcluirOF"]):
        require_once __DIR__ . '/OutrasFormacoesController.php';
        include_once __DIR__ . '/../Model/Usuario.php';
        $ofController = new OutrasFormacoesController();
        if ($ofController->remover($_POST["idOF"]) == true) {
            include_once __DIR__ . '/../View/InformacaoExcluida.php';
        } else {
            include_once __DIR__ . '/../View/OperacaoNaoRealizada.php';
        }
        break;

    // -- Visualizar Cadastro (Agenda 14) -- //
    case isset($_POST["btnVisualizar"]):
        $_SESSION['IDUsuarioVisualizar'] = $_POST['id'];
        include_once __DIR__ . '/../View/ADMVisualizarCadastro.php';
        break;

    // -- Voltar para Lista de Cadastrados (Agenda 14) -- //
    case isset($_POST["btnVoltarLista"]):
        include_once __DIR__ . '/../View/ADMListarCadastrados.php';
        break;
}
?>