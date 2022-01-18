<?php
include_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Complementar</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    * {
        margin: 0;
    }

    .registro {
        width: 100%;
        padding: 15px;
        margin-top: 20px;
        background: lightpink;
    }

    .flex {
        width: 90%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .informacoes {
        margin-top: 30px;
        width: 500px;        
    }

    .informacoes p, .informacoes h3 {
        height: 30px;
        font-weight: bold;
        background: rgb(21, 40, 100);
        color: white;
    }

    .informacoes textarea {
        padding: 3px;
        width: calc(100% - 9px);
        font-weight: bold;
        font-size: 18px;
        text-align: justify;
    }
    a{
        text-decoration: none;
        color: white;
    }
</style>

<body>


    <?php
    if (isset($_GET["idEscola"])) {
        $idEscola = $_GET["idEscola"];
        $sql = "SELECT * FROM Escola WHERE idEscola = $idEscola";
        $consulta = $conn->query($sql);
        $escola = $consulta->fetch_assoc();

    ?>
        <header>
            <nav id="barraItens">
                <ul>
                    <li><a href="home.php?idEscola=<?php echo $escola["idEscola"] ?>">VOLTAR</a></li>
                    <li><a href="telaLogin.php?idEscola=<?php echo $escola["idEscola"] ?>">LOGIN</a></li>
                </ul>
            </nav>
        </header>
        <center>
            <section class="flex">
                <?php
                $sql = "SELECT * FROM MaterialComplementar as m INNER JOIN AdministradorEscola as ae on m.Administrador_idAdministrador = ae.idAdministradorEscola WHERE ae.Escola_idEscola = $idEscola order by  idMaterialComplementar DESC";

                $dadosInformativo = $conn->query($sql);

                if ($dadosInformativo->num_rows > 0) {
                    while ($exibir = $dadosInformativo->fetch_assoc()) {

                ?>
                        <div class="informacoes">
                            <h3><?php echo $exibir["titulo"] ?></h3>

                            <textarea name="conteudo" cols="50" rows="10" disabled><?php ?><?php echo $exibir["conteudo"] ?></textarea>

                            <?php $date = new DateTime($exibir["data"]); ?>

                            <p><?php echo $date->format('d-m-Y') ?></p>
                            
                        </div>
                        <?php
                        ?>
                    <?php
                    }
                } else {
                    ?>
                    <div class="registro">
                        <h3>Nenhum registro encontrado!</h3>
                    </div>
                <?php
                }

                ?>
            </section>
        </center>

    <?php
    } else {
    ?>
        <script>
            alert("ESCOLHA UMA ESCOLA PRIMEIRO");
            window.location = "index.php";
        </script>
    <?php
    }
    ?>
</body>

</html>