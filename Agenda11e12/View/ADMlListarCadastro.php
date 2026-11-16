<?php
include_once '../Model/Usuario.php';
include_once '../Controller/UsuarioController.php';
include_once '../Controller/FormacaoAcadController.php';
include_once '../Controller/ExperienciaProfissionalController.php';
include_once '../Controller/OutrasFormacoesController.php';

if (!isset($_SESSION)) {
    session_start();
}

$idUsuario = $_SESSION['IDUsuarioVisualizar'];
$uCon = new UsuarioController();
$usuario = $uCon->visualizar($idUsuario);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Visualizar Cadastro</title>
</head>
<body class="w3-light-grey">

    <header class="w3-container w3-padding-32 w3-center">
        <h1 class="w3-text-white w3-panel w3-cyan w3-round-large">
            <?php echo htmlspecialchars($usuario->getNome()); ?> - Currículo
        </h1>
    </header>

    <!-- Dados Pessoais -->
    <div class="w3-padding-32 w3-content w3-text-grey">
        <div class="w3-container w3-card-4 w3-white w3-padding-16 w3-round-large">
            <h2 class="w3-text-cyan">Dados Pessoais</h2>
            <p class="w3-panel w3-blue w3-padding w3-round-large">
                <strong>Nome:</strong> <?php echo htmlspecialchars($usuario->getNome()); ?>
            </p>
            <p class="w3-panel w3-blue w3-padding w3-round-large">
                <strong>CPF:</strong> <?php echo htmlspecialchars($usuario->getCPF()); ?>
            </p>
            <p class="w3-panel w3-blue w3-padding w3-round-large">
                <strong>Email:</strong> <?php echo htmlspecialchars($usuario->getEmail()); ?>
            </p>
            <p class="w3-panel w3-blue w3-padding w3-round-large">
                <strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($usuario->getDataNascimento()); ?>
            </p>
        </div>
    </div>

    <!-- Formação Acadêmica -->
    <div class="w3-padding-32 w3-content w3-text-grey">
        <h2 class="w3-text-cyan">Formação Acadêmica</h2>
        <div class="w3-container">
            <table class="w3-table-all w3-centered">
                <thead>
                    <tr class="w3-center w3-blue">
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fCon = new FormacaoAcadController();
                    $results = $fCon->gerarLista($usuario->getID());
                    if ($results != null) {
                        while ($row = $results->fetch_object()) {
                            echo '<tr>';
                            echo '<td style="width: 15%;">' . $row->inicio . '</td>';
                            echo '<td style="width: 15%;">' . $row->fim . '</td>';
                            echo '<td style="width: 70%;">' . $row->descricao . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Experiência Profissional -->
    <div class="w3-padding-32 w3-content w3-text-grey">
        <h2 class="w3-text-cyan">Experiência Profissional</h2>
        <div class="w3-container">
            <table class="w3-table-all w3-centered">
                <thead>
                    <tr class="w3-center w3-blue">
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Empresa</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ePro = new ExperienciaProfissionalController();
                    $results = $ePro->gerarLista($usuario->getID());
                    if ($results != null) {
                        while ($row = $results->fetch_object()) {
                            echo '<tr>';
                            echo '<td style="width: 15%;">' . $row->inicio . '</td>';
                            echo '<td style="width: 15%;">' . $row->fim . '</td>';
                            echo '<td style="width: 25%;">' . $row->empresa . '</td>';
                            echo '<td style="width: 45%;">' . $row->descricao . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Outras Formações -->
    <div class="w3-padding-32 w3-content w3-text-grey">
        <h2 class="w3-text-cyan">Outras Formações</h2>
        <div class="w3-container">
            <table class="w3-table-all w3-centered">
                <thead>
                    <tr class="w3-center w3-blue">
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $oFor = new OutrasFormacoesController();
                    $results = $oFor->gerarLista($usuario->getID());
                    if ($results != null) {
                        while ($row = $results->fetch_object()) {
                            echo '<tr>';
                            echo '<td style="width: 15%;">' . $row->inicio . '</td>';
                            echo '<td style="width: 15%;">' . $row->fim . '</td>';
                            echo '<td style="width: 70%;">' . $row->descricao . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Botão Voltar -->
    <div class="w3-padding-32 w3-content w3-text-grey">
        <form action="../Controller/Navegacao.php" method="post" class="w3-container w3-light-grey w3-text-blue w3-margin w3-center" style="width: 30%;">
            <div class="w3-row w3-section">
                <div>
                    <button name="btnVoltarLista" class="w3-button w3-block w3-margin w3-blue w3-cell w3-round-large" style="width: 90%;">
                        Voltar
                    </button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>