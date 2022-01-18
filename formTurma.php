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
    <title>Portal Escolar - Cadastro</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php
    if (isset($_SESSION["usuario"])) {

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
        if (isset($_GET["idTurnma"])) {
            $idTurma = $_GET["idTurma"];
            $sql = "SELECT * FROM Turma WHERE idTurma = $idTurma";
            $consulta = $conn->query($sql);
            $turma = $consulta->fetch_assoc();
        }
        ?>

        <div class="formulario">

            <div class="titulo">
                <h2>Cadastro de Turma</h2><br>
            </div>

        </div>
        <div class="divCenter">
            <form action="createTurma.php" method="POST" class="turma">
                <fieldset class="turma">
                    <legend style="font-weight: bold;">Turma</legend>
                    <div class="nome">
                        <label for="nome">Nome</label><br>
                        <input name="txtNome" type="text" required placeholder="Nome...">
                    </div>

                    <div class="serie">
                        <label for="serie">Série</label><br>
                        <input name="txtSerie" type="text" required placeholder="Série...">
                    </div>

                    <div class="escola">
                        <label for="escola">Escola <label style="color:red">*</label></label><br>
                        <select name="txtEscola" required>
                          <option value="<?php echo $_SESSION["idEscola"]?>"><?php echo $_SESSION["nomeEscola"] ?></option>
                        </select>
                    </div><br>

                    <div class="divCenter">
                        <div class="botoes">
                            <button id="cadastrar">CADASTRAR</button>
                            <button id="cancelar">CANCELAR</button>
                        </div>

                </fieldset>
            </form>
        </div>
    <?php } else {
    ?>
        <script>
            alert("FAÇA LOGIN PRIMEIRO");
            window.location = "telaLogin.php";
        </script>
    <?php } ?>
</body>

</html>