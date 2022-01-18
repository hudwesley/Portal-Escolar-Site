<?php
include_once("conexao.php");

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    .flex {
        display: flex;
        flex-wrap: wrap;
        max-width: 90%;
        align-items: center;
    }

    .flex div {
        flex: 1 1 400px;
        margin: 5px;
        border: 2px solid black;
        border-bottom-style: 2px solid black;
    }

    .informacoes textarea {
        font-weight: bold;
        text-decoration: none;
        border: none;
    }

    .informacoes p {
        color: white;
        background-color: rgb(21, 40, 100);
        font-weight: bold;
    }

    footer {
        bottom: 0px;
        background: #111;
        position: relative;
    }

    .footerFinal {
        margin-top: 15px;
        display: flex;
    }

    .footerFinal .box {
        flex-basis: 50%;
        padding: 10px, 20px;
    }

    .box h2 {
        font-size: 1.125rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .left-box {
        width: 70vh;
        padding: 20px;
        text-align: justify;
    }

    .footerFinal .left-box {
        margin-right: 90px;
    }

    .center-box {
        width: 70vh;
        padding: 20px;
        padding-right: 20px;

    }
    .escola{
        padding: 10px;
        text-align: center;
    }
     .msg {
        width: 100%;
        padding: 15px;
        margin-top: 20px;
        background: lightpink;
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
                <ul style="font-size: 15px; text-align: left;">
                    <li><a href="home.php?idEscola=<?php echo $escola["idEscola"] ?>" disable>HOME</a></li>
                    <li><a href="material.php?idEscola=<?php echo $escola["idEscola"]?>">MATERIAL COMPLEMENTAR</a></li>
                    <li><a href="index.php">LISTA DE ESCOLAS</a></li>
                    <li><a href="telaLogin.php?idEscola=<?php echo $escola["idEscola"] ?>">LOGIN</a></li>
                </ul>
            </nav>
        </header>

        <div style="top: -16.5px;" id="carrosselHome" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="">
                        <img style="height: 45ch;" src="uploads/teste_img1.png" class="w-100" alt="...">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="">
                        <img style="height: 45ch;" src="uploads/teste_img2.png" class="w-100" alt="...">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="">
                        <img style="height: 45ch;" src="uploads/teste_img3.png" class="w-100" alt="...">
                    </a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carrosselHome" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carrosselHome" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <center>
            <section class="flex">
                <?php
                $sql = "SELECT * FROM Informativo as i INNER JOIN AdministradorEscola as ae on i.Administrador_idAdministrador = ae.idAdministradorEscola WHERE ae.Escola_idEscola = $idEscola order by data DESC";

                $dadosInformativo = $conn->query($sql);

                if ($dadosInformativo->num_rows > 0) {
                    while ($exibir = $dadosInformativo->fetch_assoc()) {

                ?>
                        <div class="informacoes">
                            <textarea name="conteudo" cols="50" rows="10" disabled><?php ?><?php echo $exibir["conteudo"] ?></textarea>

                            <p><?php echo $exibir["titulo"] ?></p>

                            <?php $date = new DateTime($exibir["data"]); ?>

                            <p><?php echo $date->format('d-m-Y') ?></p>
                            
                        </div>
                        <?php
                        ?>
                <?php
                    }
                } else {
                    ?>
                        <h2 class="msg">Nenhum informativo encontrado!</h2>
                    <?php 
                }

                ?>
            </section>
        </center>
        <footer>
            <div class="footerFinal" style="color: white;">
                <div class="left-box">
                    <h2>Sobre nós:</h2>
                    <div class="content">
                        <p><?php echo $escola["descricao"] ?></p>
                    </div>
                </div>

                <div class="center-box">
                    <h2>Contato</h2>
                    <div class="place">
                        <span class="fas fa-map-marker-alt"></span>
                        <span class="text"><?php echo $escola["cep"] . " " . $escola["estado"] ?></span>
                    </div>
                    <div class="telephone">
                        <i class="bi bi-telephone"></i>
                        <span class="text"><?php echo $escola["telefone"]  ?></span>
                    </div>
                    <div class="email">
                        <i class="far fa-envelope"></i>
                        <span class="text"><?php echo $escola["email"]  ?></span>
                    </div>
                </div>
            </div>
            <div class="text-center p-4" style="background: gray; padding-bottom: 5px; height: 20px;">
                <p style="color: black; font-weight: bold; padding: 0;">© 2021 Copyright: TCC - INFORMÁTICA - Portal Escolar</p>
            </div>
        </footer>
    <?php } else { ?>
       <h2>Escola não encontrada. <strong><a href="index.php">Selecione uma aqui!</a></strong></h2>
    <?php } ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</html>