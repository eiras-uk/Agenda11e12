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


    // Agenda 14 - Entrar no módulo administrador
    case isset($_POST["btnADM"]):
        include_once __DIR__ . '/../View/ADMLogin.php';
        break;


    case isset($_POST["btnLoginADM"]):
        require_once __DIR__ . '/AdministradorController.php';
        $aController = new AdministradorController();
        if ($aController->login($_POST["txtLoginADM"], $_POST["txtSenhaADM"])) {
            include_once __DIR__ . '/../View/ADMPrincipal.php';
        } else {
            include_once __DIR__ . '/../View/ADMLogin.php';
            echo '<p class="w3-panel w3-red w3-center">CPF ou senha inválidos.</p>';
        }
        break;


    case isset($_POST["btnListarCadastrados"]):
        include_once __DIR__ . '/../View/ADMListarCadastrados.php';
        break;


    case isset($_POST["btnVisualizar"]):
        $_SESSION['IDUsuarioVisualizar'] = (int)$_POST['id'];
        include_once __DIR__ . '/../View/ADMVisualizarCadastro.php';
        break;


    case isset($_POST["btnVoltarLista"]):
        include_once __DIR__ . '/../View/ADMListarCadastrados.php';
        break;


    case isset($_POST["btnVoltarADMPrincipal"]):
        include_once __DIR__ . '/../View/ADMPrincipal.php';
        break;


    case isset($_POST["btnSairADM"]):
        unset($_SESSION['Administrador']);
        include_once __DIR__ . '/../View/login.php';
        break;


    case isset($_POST["btnVoltarLogin"]):
        include_once __DIR__ . '/../View/login.php';
        break;


}
?>
