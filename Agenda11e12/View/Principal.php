<?php
include_once '../Model/Usuario.php';
include_once '../Controller/FormacaoAcadController.php';
include_once '../Controller/ExperienciaProfissionalController.php';
include_once '../Controller/OutrasFormacoesController.php';

if (!isset($_SESSION)) {
    session_start();
}

// Recupera o usuário logado da sessão
$usuario = unserialize($_SESSION['Usuario']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Enlatados Juarez - Sistema de Currículos</title>
    <style>
        .w3-sidebar {
            width: 120px;
        }
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Montserrat", sans-serif;
        }
    </style>
</head>
<body class="w3-light-grey">

    <!-- Barra Lateral (Sidebar) -->
    <nav class="w3-sidebar w3-bar-block w3-center w3-blue">
        <a href="#home" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-home w3-xxlarge"></i>
            <p>HOME</p>
        </a>
        <a href="#dPessoais" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-address-book-o w3-xxlarge"></i>
            <p>Dados Pessoais</p>
        </a>
        <a href="#formacao" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-mortar-board w3-xxlarge"></i>
            <p>Formação</p>
        </a>
        <a href="#eProfissional" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-briefcase w3-xxlarge"></i>
            <p>Experiência</p>
        </a>
        <a href="#outrasFormacoes" class="w3-bar-item w3-button w3-block w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-certificate w3-xxlarge"></i>
            <p>Outras Formações</p>
        </a>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="w3-padding-large" style="margin-left: 120px;" id="main">

        <!-- Seção Home -->
        <header class="w3-container w3-padding-32 w3-center" id="home">
            <h1>
                <img src="../Img/Enlatados.png" alt="Logo" class="w3-image" width="50%">
            </h1>
            <a class="w3-text-cyan" href="http://www.freepik.com">Designed by brgfx / Freepik</a>
            <h1 class="w3-text-cyan">SISTEMA DE CURRÍCULOS</h1>
        </header>

        <!-- Dados Pessoais -->
        <div class="w3-padding-128 w3-content w3-text-grey" id="dPessoais">
            <h2 class="w3-text-cyan">Dados Pessoais</h2>

            <form action="../Controller/Navegacao.php" method="post" class="w3-row w3-light-grey w3-text-blue w3-margin" style="width:70%;">
                <input class="w3-input w3-border w3-round-large" name="txtID" type="hidden" value="<?php echo $usuario->getID(); ?>">

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%;">
                        <i class="w3-xxlarge fa fa-user"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtNome" type="text" placeholder="Nome Completo" value="<?php echo htmlspecialchars($usuario->getNome()); ?>" required>
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%;">
                        <i class="w3-xxlarge fa fa-calendar"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtData" type="date" value="<?php echo htmlspecialchars($usuario->getDataNascimento() ?? ''); ?>">
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%;">
                        <i class="w3-xxlarge fa fa-drivers-license"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtCPF" type="text" placeholder="CPF: 33333333333" value="<?php echo htmlspecialchars($usuario->getCPF()); ?>" required>
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%;">
                        <i class="w3-xxlarge fa fa-envelope-o"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtEmail" type="email" placeholder="Email" value="<?php echo htmlspecialchars($usuario->getEmail()); ?>" required>
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-center">
                        <button name="btnAtualizar" class="w3-button w3-block w3-margin w3-blue w3-cell w3-round-large" style="width: 90%;">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Formação Acadêmica -->
        <div class="w3-padding-128 w3-content w3-text-grey" id="formacao">
            <h2 class="w3-text-cyan">Formação Acadêmica</h2>

            <form action="../Controller/Navegacao.php" method="post" class="w3-row w3-light-grey w3-text-blue w3-margin" style="width:70%;">
                <div class="w3-row w3-center">
                    <div class="w3-col" style="width:50%;">Data Inicial</div>
                    <div class="w3-rest">Data Final</div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-row w3-section w3-col" style="width:45%;">
                        <div class="w3-col" style="width:15%;">
                            <i class="w3-xxlarge fa fa-calendar"></i>
                        </div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtInicioFA" type="date">
                        </div>
                    </div>

                    <div class="w3-row w3-section w3-rest">
                        <div class="w3-col w3-margin-left" style="width:13%;">
                            <i class="w3-xxlarge fa fa-calendar"></i>
                        </div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtFimFA" type="date">
                        </div>
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:7%;">
                        <i class="w3-xxlarge fa fa-align-justify"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtDescFA" type="text" placeholder="Descrição: Ex.: Técnico em Desenvolvimento de Sistemas - Centro Paula Souza">
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-center">
                        <button name="btnAddFormacao" class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 20%;">
                            <i class="w3-xxlarge fa fa-user-plus"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Tabela Formação Acadêmica -->
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fCon = new FormacaoAcadController();
                        $results = $fCon->gerarLista($usuario->getID());
                        if ($results != null) {
                            while ($row = $results->fetch_object()) {
                                echo '<tr>';
                                echo '<td style="width: 10%;">' . $row->inicio . '</td>';
                                echo '<td style="width: 10%;">' . $row->fim . '</td>';
                                echo '<td style="width: 65%;">' . $row->descricao . '</td>';
                                echo '<td style="width: 5%;">
                                    <form action="../Controller/Navegacao.php" method="post">
                                        <input type="hidden" name="id" value="' . $row->idformacaoAcademica . '">
                                        <button name="btnExcluirFA" class="w3-button w3-block w3-blue w3-cell w3-round-large">
                                            <i class="fa fa-user-times"></i>
                                        </button>
                                    </form>
                                </td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Experiência Profissional -->
        <div class="w3-padding-128 w3-content w3-text-grey" id="eProfissional">
            <h2 class="w3-text-cyan">Experiência Profissional</h2>

            <form action="../Controller/Navegacao.php" method="post" class="w3-row w3-light-grey w3-text-blue w3-margin" style="width: 70%;">
                <div class="w3-row w3-center">
                    <div class="w3-col" style="width:50%;">Data Inicial</div>
                    <div class="w3-rest">Data Final</div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-row w3-section w3-col" style="width:45%;">
                        <div class="w3-col" style="width:15%;">
                            <i class="w3-xxlarge fa fa-calendar"></i>
                        </div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtInicioEP" type="date">
                        </div>
                    </div>

                    <div class="w3-row w3-section w3-rest">
                        <div class="w3-col w3-margin-left" style="width:13%;">
                            <i class="w3-xxlarge fa fa-calendar"></i>
                        </div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtFimEP" type="date">
                        </div>
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:7%;">
                        <i class="w3-xxlarge fa fa-align-justify"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtEmpEP" type="text" placeholder="Centro Paula Souza">
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:7%;">
                        <i class="w3-xxlarge fa fa-align-justify"></i>
                    </div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtDescEP" type="text" placeholder="Descrição: Ex.: Desenvolvimento WEB">
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-center">
                        <button name="btnAddEP" class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 20%;">
                            <i class="w3-xxlarge fa fa-user-plus"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Tabela Experiência Profissional -->
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Empresa</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ePro = new ExperienciaProfissionalController();
                        $results = $ePro->gerarLista($usuario->getID());
                        if ($results != null) {
                            while ($row = $results->fetch_object()) {
                                echo '<tr>';
                                echo '<td style="width: 10%;">' . $row->inicio . '</td>';
                                echo '<td style="width: 10%;">' . $row->fim . '</td>';
                                echo '<td style="width: 10%;">' . $row->empresa . '</td>';
                                echo '<td style="width: 65%;">' . $row->descricao . '</td>';
                                echo '<td style="width: 5%;">
                                    <form action="../Controller/Navegacao.php" method="post">
                                        <input type="hidden" name="idEP" value="' . $row->idexperienciaprofissional . '">
                                        <button name="btnExcluirEP" class="w3-button w3-block w3-blue w3-cell w3-round-large">
                                            <i class="fa fa-user-times"></i>
                                        </button>
                                    </form>
                                </td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Outras Formações -->
        <div class="w3-padding-128 w3-content w3-text-grey" id="outrasFormacoes">
            <h2 class="w3-text-cyan">Outras Formações</h2>

            <form action="../Controller/Navegacao.php" method="post" class="w3-row w3-light-grey w3-text-blue w3-margin" style="width: 70%;">
                <div class="w3-row w3-center">
                    <div class="w3-col" style="width:50%;">Data Inicial</div>
                    <div class="w3-rest">Data Final</div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-row w3-section w3-col" style="width:45%;">
                        <div class="w3-col" style="width:15%;">
                            <i class="w3-xxlarge fa fa-calendar"></i>
                        </div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtInicioOF" type="date">
                        </div>
                    </div>

                    <div class="w3-row w3-section w3-rest">
                        <div class="w3-col w3-margin-left" style="width:13%;">
                            <i class="w3-xxlarge fa fa-calendar"></i>
                        </div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtFimOF" type="date">
                        </div>
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:7%;">
                        <i class="w3-xxlarge fa fa-align-justify"></i>
                    </div>
                    <div class="w3-rest">
                        <!-- CORRIGIDO: name="txtDescOF" -->
                        <input class="w3-input w3-border w3-round-large" name="txtDescOF" type="text" placeholder="Ex: Curso de Inglês - Inglês City">
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-center">
                        <button name="btnAddOF" class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 20%;">
                            <i class="w3-xxlarge fa fa-user-plus"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Tabela Outras Formações -->
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $oFor = new OutrasFormacoesController();
                        $results = $oFor->gerarLista($usuario->getID());
                        if ($results != null) {
                            while ($row = $results->fetch_object()) {
                                echo '<tr>';
                                echo '<td style="width: 10%;">' . $row->inicio . '</td>';
                                echo '<td style="width: 10%;">' . $row->fim . '</td>';
                                echo '<td style="width: 65%;">' . $row->descricao . '</td>';
                                echo '<td style="width: 5%;">
                                    <form action="../Controller/Navegacao.php" method="post">
                                        <input type="hidden" name="idOF" value="' . $row->idoutrasformacoes . '">
                                        <button name="btnExcluirOF" class="w3-button w3-block w3-blue w3-cell w3-round-large">
                                            <i class="fa fa-user-times"></i>
                                        </button>
                                    </form>
                                </td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>
