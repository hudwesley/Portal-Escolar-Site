<?php
include_once("conexao.php");
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wth=device-wth, initial-scale=1.0">
    <title>Portal Escolar - Cadastro</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php
    if (isset($_SESSION["usuario"])) {
        $idEscola = $_SESSION["idEscola"];
    ?>

        <header>
            <div style="background-color: rgb(21, 40, 100); text-align: center; padding-top: 10px; color: white; font-weight: bold">
                Olá, <?php echo $_SESSION["nomeAdm"]; ?>
            </div>
            <nav id="barraItens">
                <ul>
                    <li><a href="listaDisciplina.php">LISTA DE DISCIPLINAS</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>

        <?php
        if (isset($_GET["idDisciplinas"])) {
            $idDisciplinas = $_GET["idDisciplinas"];
            $sql = "SELECT * FROM Disciplina WHERE idDisciplinas = $idDisciplinas";
            $consulta = $conn->query($sql);
            $disciplina = $consulta->fetch_assoc();
        }
        ?>

        <div class="formulario">
            <div class="titulo">
                <h2>Cadastro de Disciplinas</h2><br>
            </div>

            <div class="divCenter">
                <form action="createDisciplina.php" method="POST" class="cadastro">
                    <fieldset class="disciplina">
                        <legend style="font-weight: bold;">Disciplina</legend>

                        <div class="nome">
                            <label for="nome">Nome</label><br>
                            <input name="nome" type="text" required placeholder="Nome da disciplina...">
                        </div>

                        <div class="serie">
                            <label for="serie">Série</label><br>
                            <input name="serie" type="text" required placeholder="Série...">
                        </div>

                        <div class="turma">
                            <label for="turma">Turma</label><br>
                            <select name="turma" required>
                                <?php
                                $sql = "SELECT * FROM Turma WHERE Escola_idEscola = $idEscola order by  nome";

                                $dadosTurma = $conn->query($sql);

                                if ($dadosTurma->num_rows > 0) {
                                ?>
                                    <?php
                                    while ($exibir = $dadosTurma->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $exibir["idTurma"] ?>"><?php echo $exibir["nome"] ?></option>
                                    <?php
                                    }
                                    ?>
                                <?php
                                }
                                ?>
                            </select>
                        </div><br>
                        <div class="professor">
                            <label for="professor">Professor</label><br>
                            <select name="professor">
                                <?php
                                $sql = "SELECT * FROM AdministradorEscola WHERE Escola_idEscola = $idEscola order by nome";

                                $dadosAdm = $conn->query($sql);

                                if ($dadosAdm->num_rows > 0) {
                                ?>
                                    <?php
                                    while ($exibir = $dadosAdm->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $exibir["nome"] ?>"><?php echo $exibir["nome"] ?></option>
                                    <?php
                                    }
                                    ?>
                                <?php
                                }
                                ?>
                            </select>
                        </div><br>

                        <div class="divCenter">
                            <div class="botoes">
                                <button id="cadastrar">CADASTRAR</button>
                                <button id="cancelar">CANCELAR</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            <?php } else {
            ?>
                <script>
                    alert("FAÇA LOGIN PRIMEIRO");
                    window.location = "telaLogin.php";
                </script>
            <?php } ?>
</body>

</html>