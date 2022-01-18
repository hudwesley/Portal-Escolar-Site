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
    <title>Portal Escolar - Editar</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    if (isset($_SESSION["usuario"])) {
        $escola = $_SESSION["idEscola"];
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

        ?>

            <div class="formulario">
                <div class="titulo">
                    <h2><?php echo $disciplina["nome"] ?></h2><br>
                </div>

                <div class="divCenter">
                    <form action="updateDisciplina.php?idDisciplinas=<?php echo $_GET['idDisciplinas'] ?>" method="POST" class="cadastro">
                        <fieldset class="disciplina">
                            <legend style="font-weight: bold;">Disciplina</legend>

                            <div class="nome">
                                <label for="nome">Nome</label><br>
                                <input name="nome" type="text" required value="<?php echo $disciplina["nome"] ?>">
                            </div>



                            <div class="serie">
                                <label for="serie">Série</label><br>
                                <input name="serie" type="text" required value="<?php echo $disciplina["serie"] ?>">
                            </div>

                            <div class="turma">
                                <label for="turma">Turma</label><br>
                                <select name="turma" required>
                                    <?php
                                    include_once("conexao.php");
                                    $sql = "SELECT idTurma, nome FROM Turma WHERE Escola_idEscola = $escola";

                                    $turma = $conn->query($sql);
                                    while ($rowTurma = $turma->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $rowTurma["idTurma"]; ?>" <?php echo ($rowTurma["idTurma"] == $disciplina["Turma_idTurma"]) ? "selected" : "" ?>> <?php echo $rowTurma["nome"] ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><br>
                            <div class="professor">
                                <label for="professor">Professor</label><br>
                                <select name="professor">
                                    <?php
                                    include_once("conexao.php");
                                    $sql = "SELECT nome FROM AdministradorEscola WHERE Escola_idEscola = $escola";

                                    $dadosAdm = $conn->query($sql);
                                    while ($rowAdm = $dadosAdm->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $rowAdm["nome"]; ?>" <?php echo ($rowAdm["nome"] == $disciplina["professor"]) ? "selected" : "" ?>> <?php echo $rowAdm["nome"] ?> </option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <script>
                                        alert("ESCOLHA UMA DISCIPLINA PRIMEIRO!");
                                        window.location = "listaDisciplina.php";
                                    </script>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="divCenter">
                                <div class="botoes">
                                    <button type="submit" id="cadastrar">SALVAR</button>
                                    <button type="reset" id="cancelar">CANCELAR</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        <?php } else {
        ?>
            <script>
                alert("PARA UTILIZAR OS RECURSOS, PRIMEIRO FAÇA LOGIN");
                window.location = "telaLogin.php";
            </script>
        <?php } ?>
</body>

</html>