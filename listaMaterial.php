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
    <title>Portal Escolar - Materiais Complementares</title>
    <link rel="stylesheet" href="css/material.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
    h2 {
        padding: 20px;
        margin-top: 10px;
        margin-bottom: 10px;
        background: linear-gradient(to right, rgb(21, 40, 100), rgb(21, 40, 100), rgb(21, 40, 100), rgb(21, 40, 100), rgb(21, 40, 100), black);
        color: whitesmoke;
    }
    .registro h2{
        background: rgb(21, 40, 100);
    }
    a {
        text-decoration: none;
        text-transform: uppercase;
        color: springgreen;
    }

    h4 {
        text-align: justify;
        margin: 10px;
    }

    .boxMaterial {
        margin: 15px 15px 0 15px;
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
                    <li><a href="formMaterial.php">CADASTRO DE MATERIAL COMPLEMENTAR</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>
        
        <?php
        $sql = "SELECT * FROM MaterialComplementar as m INNER JOIN AdministradorEscola as ae on m.Administrador_idAdministrador = ae.idAdministradorEscola WHERE ae.Escola_idEscola = $idEscola order by  idMaterialComplementar DESC";

        $dadosMaterial = $conn->query($sql);

        if ($dadosMaterial->num_rows > 0) {
        ?>
            <?php
            while ($exibir = $dadosMaterial->fetch_assoc()) {
            ?>
                <fieldset class="boxMaterial">
                    <div class="header">
                        <h2><?php echo $exibir["titulo"] ?></h2>
                    </div>

                    <div class="conteudo">
                        <h4><?php echo $exibir["conteudo"] ?></h4>
                    </div>

                    <div class="data">
                        <?php
                        $date = new DateTime($exibir["data"]);
                        ?>
                        <h4><?php echo $date->format('d-m-Y') ?></h4>
                    </div>

                    <div class="botoes">
                        <button class="editar" type="submit"><a style="text-decoration: none; color: black; font-weight: bold;" href="editarMaterial.php?idmaterialComplementar=<?php echo $exibir["idmaterialComplementar"] ?>"><i class="fa fa-pencil-square-o" style="font-size:24px"></i></a></button>
                        <button class="excluir"><a style="text-decoration: none; color: black; font-weight: bold;" href="#" onclick="confirmarExclusao('<?php echo $exibir["idmaterialComplementar"] ?>', '<?php echo $exibir["titulo"] ?>')"><i style='font-size:24px' class="material-icons">&#xe92b;</i></a></button>
                    </div>
                </fieldset>

            <?php
            }
            ?>
        <?php
        } else {
        ?>
            <div class="registro">
                <h2>Nenhum registro encontrado. <a href="formMaterial.php">Cadastre aqui</a></h2>
            </div>
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
    function confirmarExclusao(idmaterialComplementar, titulo) {
        if (window.confirm("Deseja confirmar a exclusão? \n" + idmaterialComplementar + " - " + titulo)) {
            window.location = "excluirMaterial.php?idmaterialComplementar=" + idmaterialComplementar;
        }
    }
</script>

</html>