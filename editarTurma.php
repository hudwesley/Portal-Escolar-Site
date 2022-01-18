<?php
include_once("conexao.php");
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <li><a href="listaTurma.php">LISTA DE TURMAS</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>

        <?php
        if (isset($_GET["idTurma"])) {
            $idTurma = $_GET["idTurma"];
            $sql = "SELECT * FROM Turma WHERE idTurma = $idTurma";
            $consulta = $conn->query($sql);
            $turma = $consulta->fetch_assoc();

        ?>

            <div class="formulario">

                <div class="titulo">
                    <h2><?php echo $turma["nome"] ?></h2><br>
                </div>

            </div>
            <div class="divCenter">
                <form action="updateTurma.php?idTurma=<?php echo $_GET['idTurma'] ?>" method="POST" class="turma">
                    <fieldset class="turma">
                        <legend style="font-weight: bold;">Turma</legend>
                        <div class="nome">
                            <label for="nome">Nome</label><br>
                            <input name="nome" type="text" value="<?php echo $turma["nome"] ?>">
                        </div>

                        <div class="serie">
                            <label for="serie">Série</label><br>
                            <input name="serie" type="text" value="<?php echo $turma["serie"] ?>">
                        </div>

                        <div class="escola">
                            <label for="escola">Escola <label style="color:red">*</label></label><br>
                            <select name="escola" required>
                                <?php
                                include_once("conexao.php");
                                $sql = "SELECT idEscola, nome FROM Escola WHERE idEscola = $escola";

                                $escola = $conn->query($sql);
                                while ($rowEscola = $escola->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $rowEscola["idEscola"]; ?>" <?php echo ($rowEscola["idEscola"] == $turma["Escola_idEscola"]) ? "selected" : "" ?>> <?php echo $rowEscola["nome"] ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div><br>

                        <div class="divCenter">
                            <div class="botoes">
                                <button type="submit" id="cadastrar">SALVAR</button>
                                <button type="reset" id="cancelar">CANCELAR</button>
                            </div>
                    </fieldset>
                </form>
            </div>
        <?php } else {
        ?>
            <script>
                alert("ESCOLHA UMA TURMA PRIMEIRO!");
                window.location = "listaTurma.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("PARA UTILIZAR OS RECURSOS, PRIMEIRO FAÇA LOGIN");
            window.location = "telaLogin.php";
        </script>
    <?php } ?>
</body>

</html>