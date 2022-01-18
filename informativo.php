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
    <title>Home Administrador</title>


    <link rel="stylesheet" href="css/style.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 
</head>
<style>
    h5,
    h6 {
        font-weight: bold;
        margin-top: 5px;
    }
</style>

<body>
    <?php
    if (isset($_SESSION["usuario"])) {

    ?>
        <header>

            <?php
            if (isset($_GET["idInformativo"])) {
                $idInformativo = $_GET["idInformativo"];
                $sql = "SELECT i.titulo, i.conteudo, i.data, ae.nome as nome FROM Informativo as i INNER JOIN AdministradorEscola as ae ON i.Administrador_idAdministrador = ae.idAdministradorEscola WHERE i.idInformativo = $idInformativo";
                $consulta = $conn->query($sql);
                $informativo = $consulta->fetch_assoc();

            ?>

                <div style="background-color: rgb(21, 40, 100); text-align: center; padding-top: 10px; color: white; font-weight: bold">
                    Olá, <?php echo $_SESSION["nomeAdm"]; ?><br>
                </div>

                <nav id="barraItens">
                    <ul style="font-size: 15px;">
                        <li><a href="listaInformativo.php">INFORMATIVOS</a></li>
                        <li><a href="homeLogin.php">HOME</a></li>
                    </ul>
                </nav>
        </header>

        <div class="titulo">
            <h2><b><?php echo $informativo["titulo"] ?></b></h2>
        </div>
        <br>

        <center>
            <div class="layoutInformativo" style="width: 600px; height: auto; text-align: justify;">
                <div class="conteudo">
                    <h4 name="txtConteudo"><?php echo $informativo["conteudo"] ?></h4>
                </div>
                <br>
                <div class="data">
                    <?php
                    $date = new DateTime($informativo["data"]);
                    ?>
                    <h5><i style='font-size:24px' class='fas'>&#xf073;</i> <?php echo $date->format('d-m-Y') ?></h5>
                </div>
                <div class="autor">
                    <h5 name="autor"><i style='font-size:24px' class='fas'>&#xf406;</i> <?php echo $informativo["nome"] ?></h5>
                </div>
            </div>
        </center>

    <?php
            } else {
    ?>
        <script>
            alert("ESCOLHA UM INFORMATIVO PRIMEIRO");
            window.location = "listaInformativo.php";
        </script>
    <?php
            }
        } else {
    ?>
    <script>
        alert("FAÇA LOGIN PRIMEIRO");
        window.location = "telaLogin.php";
    </script>
<?php } ?>

</body>

</html>