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
        require_once "../Controller/UsuarioController.php";
        $uController = new UsuarioController();
        if ($uController->atualizar(
            $_POST["txtID"],
            $_POST["txtNome"],
            $_POST["txtCPF"],
            $_POST["txtEmail"],
            date("Y-m-d", strtotime($_POST["txtData"]))
        )) {
            include_once "../View/atualizacaoRealizada.php";
        } else {
            include_once "../View/operacaoNaoRealizada.php";
        }
        break;

    // -- Adicionar Formação Acadêmica -- //
    case isset($_POST["btnAddFormacao"]):
        require_once "../Controller/FormacaoAcadController.php";
        include_once "../Model/Usuario.php";
        $fController = new FormacaoAcadController();
        if ($fController->inserir(
            date("Y-m-d", strtotime($_POST["txtInicioFA"])),
            date("Y-m-d", strtotime($_POST["txtFimFA"])),
            $_POST["txtDescFA"],
            unserialize($_SESSION["Usuario"])->getID()
        ) != false) {
            include_once "../View/informacaoInserida.php";
        } else {
            include_once "../View/operacaoNaoRealizada.php";
        }
        break;

    // -- Excluir Formação Acadêmica -- //
    case isset($_POST["btnExcluirFA"]):
        require_once "../Controller/FormacaoAcadController.php";
        include_once "../Model/Usuario.php";
        $fController = new FormacaoAcadController();
        if ($fController->remover($_POST["id"]) == true) {
            include_once "../View/informacaoExcluida.php";
        } else {
            include_once "../View/operacaoNaoRealizada.php";
        }
        break;

    // -- Adicionar Outras Formações (Agenda 13) -- //
    case isset($_POST["btnAddOF"]):
        require_once "../Controller/OutrasFormacoesController.php";
        include_once "../Model/Usuario.php";
        $ofController = new OutrasFormacoesController();
        if ($ofController->inserir(
            date("Y-m-d", strtotime($_POST["txtInicioOF"])),
            date("Y-m-d", strtotime($_POST["txtFimOF"])),
            $_POST["txtDescOF"],
            unserialize($_SESSION["Usuario"])->getID()
        ) != false) {
            include_once "../View/informacaoInserida.php";
        } else {
            include_once "../View/operacaoNaoRealizada.php";
        }
        break;

    // -- Excluir Outras Formações (Agenda 13) -- //
    case isset($_POST["btnExcluirOF"]):
        require_once "../Controller/OutrasFormacoesController.php";
        include_once "../Model/Usuario.php";
        $ofController = new OutrasFormacoesController();
        if ($ofController->remover($_POST["idOF"]) == true) {
            include_once "../View/informacaoExcluida.php";
        } else {
            include_once "../View/operacaoNaoRealizada.php";
        }
        break;
}
?>