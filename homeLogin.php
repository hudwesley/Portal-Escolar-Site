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
    <title><?php echo $_SESSION["nomeEscola"] ?> </title>
    <link rel="stylesheet" href="css/style.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
    * {
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
        list-style: none;
        text-decoration: none;
    }

    .sidebar {
        position: fixed;
        left: 0;
        width: 280px;
        height: 100%;
        background: rgb(21, 40, 100);
        padding: 10px;
    }

    .sidebar header {
        font-size: 30px;
        color: whitesmoke;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-style: oblique;
        text-align: center;
        line-height: 70px;
        background: rgb(21, 40, 100);
        user-select: none;

    }
    .sidebar ul li:hover{
        border-radius: 55px;
    }
    .sidebar ul a {
        display: block;
        height: 100%;
        width: 100%;
        line-height: 65px;
        font-size: 17px;
        color: whitesmoke;
        font-weight: bold;
        padding-left: 30px;
        box-sizing: border-box;
        border-top: 1px solid rgba(255, 255, 255, .1);
        border-bottom: 1px solid black;

    }

    .sidebar ul a:last-child {
        margin-top: 2px;
        border-bottom: none;
    }

    ul li:hover a {
        padding-left: 50px;
        transition: 0.4s;
        font-weight: bold;
        border: 1px solid lightblue;
        border-radius: 55px;
        background: whitesmoke;
        margin-right: 3px;
        opacity: 0.7;
        color: black;
    }

    ul li:last-child {
        background: #ff4040;
        opacity: 8;
        border-radius: 55px;
    }

    h3,
    h4 {
        margin-left: 249px;
        text-align: right;
        background: rgb(21, 40, 100);
        color: white;
        padding: 13px 20px 5px 0;
    }
</style>

<body>
    <?php
    if (isset($_SESSION["usuario"])) {

    ?>
        <div class="sidebar">
            <header>PORTAL ESCOLAR</header>
            <ul>
                <li><a href="listaEscola.php"><i style='font-size:24px' class='fas'>&#xf549;</i> Escola</a></li>
                <li><a href="listaAdm.php"><i style='font-size:24px' class='fas'>&#xf508;</i> Administrador</a></li>
                <li><a href="listaAluno.php"><i style='font-size:24px' class='fas'>&#xf501;</i> Aluno</a></li>
                <li><a href="listaTurma.php"><i class="material-icons">&#xe7fb;</i> Turma</a></li>
                <li><a href="listaDisciplina.php"><i class="material-icons">&#xe02f;</i> Disciplina</a></li>
                <li><a href="listaInformativo.php"><i style='font-size:24px' class='fas'>&#xf5da;</i> Informativo</a></li>
                <li><a href="listaMaterial.php"><i style='font-size:24px' class='fas'>&#xf1c1;</i> Material Complementar</a></li>
                <li><a href="logout.php"><i style='font-size:24px' class='fas'>&#xf52b;</i> Sair</a></li>
            </ul>
        </div>
        <h3><i style='font-size:24px' class='fas'>&#xf406;</i> Olá, <?php echo $_SESSION["nomeAdm"] ?></h3>
        <h4><?php echo $_SESSION["nomeEscola"] ?></h4>
    <?php } else {
    ?>
        <script>
            alert("FAÇA LOGIN PRIMEIRO");
            window.location = "telaLogin.php";
        </script>
    <?php } ?>

</body>

</html>