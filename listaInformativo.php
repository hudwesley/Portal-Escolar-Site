<?php
include_once("conexao.php");
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Escolar - Informativos</title>
    <link rel="stylesheet" href="css/material.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<style>
    h2 {
        padding: 20px;
        margin-top: 10px;
        margin-bottom: 10px;
        background-color: #29539b;
        background-image: linear-gradient(315deg, #29539b 0%, #1e3b70 74%);
        color: whitesmoke;
    }

    .registro h2 {
        background: rgb(21, 40, 100);
    }

    a {
        text-decoration: none;
        text-transform: uppercase;
        color: springgreen;
    }

    h3 {
        text-align: justify;
        margin: 10px;
    }


    .boxMaterial {
        margin: 15px 15px 0 15px;
    }

    .boxInfo {
        width: 900px;
    }

    .botoes {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .botoes button {
        height: 30px;
    }
</style>

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
                    <li><a href="formInformativo.php">CADASTRO DE INFORMATIVO</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>
        <center>
            <?php
            $sql = "SELECT * FROM Informativo as i INNER JOIN AdministradorEscola as ae on i.Administrador_idAdministrador = ae.idAdministradorEscola WHERE ae.Escola_idEscola = $idEscola order by  data DESC";

            $dadosInformativo = $conn->query($sql);

            if ($dadosInformativo->num_rows > 0) {
            ?>
                <?php
                while ($exibir = $dadosInformativo->fetch_assoc()) {
                ?>
                    <div class="boxInfo">
                        <fieldset class="boxMaterial">
                            <div class="header">
                                <h2><?php echo $exibir["titulo"] ?></h2>
                            </div>
                            <div class="conteudo">
                                <h3><?php echo $exibir["conteudo"] ?></h3>
                            </div>
                            <div class="data">
                                <?php
                                $date = new DateTime($exibir["data"]);
                                ?>
                               <h4><?php echo $exibir["nome"] . "   -  " . $date->format('d-m-Y') ?></h4>
                            </div>
                            
                            <div class="botoes">
                                <button class="editar" type="submit"><a style="text-decoration: none; color: black; font-weight: bold;" href="editarInformativo.php?idInformativo=<?php echo $exibir["idInformativo"] ?>"><i class="fa fa-pencil-square-o" style="font-size:24px"></i></a></button>
                                <button class="excluir" type="reset"><a style="text-decoration: none; color: black; font-weight: bold;" href="#" onclick="confirmarExclusao('<?php echo $exibir["idInformativo"] ?>', '<?php echo $exibir["titulo"] ?>')"><i style='font-size:24px' class="material-icons">&#xe92b;</i></a></button>
                                <button class="visualizar" type="submit"><a style="text-decoration: none; color: black; font-weight: bold;" href="informativo.php?idInformativo=<?php echo $exibir["idInformativo"] ?>"><i style='font-size:24px' class='fas'>&#xf5da;</i></a></button>
                            </div>
                        </fieldset>
                    </div>

                <?php
                }
                ?>
        </center>
    <?php
            } else {
    ?>

        <h2>Nenhum registro encontrado. <a href="formInformativo.php">Cadastre aqui!</a></h2>

    <?php
            }
    ?>
<?php } else {
?>
    <script>
        alert("FAÇA LOGIN PRIMEIRO");
        window.location = "telaLogin.php";
    </script>
<?php } ?>
</body>

<script>
    function confirmarExclusao(idInformativo, titulo) {
        if (window.confirm("Deseja confirmar a exclusão? \n" + idInformativo + " - " + titulo)) {
            window.location = "excluirInformativo.php?idInformativo=" + idInformativo;
        }
    }
</script>

</html>