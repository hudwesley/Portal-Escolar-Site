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
    <title>Portal Escolar - Disciplinas</title>
    <link rel="stylesheet" href="css/material.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
        h4 {
        padding: 20px;
        margin-top: 10px;
        margin-bottom: 10px;
        background: rgb(21, 40, 100);
        color: whitesmoke;
    }
     a{
         font-size: 20px;
        text-decoration: none;
        text-transform: uppercase;
        color: springgreen;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tblAluno {
        margin-bottom: 30px;
        width: 90%;
        border-collapse: collapse;
        padding: 10px;
        text-align: center;
        font-weight: bold;
        border: 2px black solid;
        border-top-style: none;
        border-left-style: none;
        border-right-style: none;
    }

    .tblHead {
        height: 40px;
        background-color: rgb(21, 40, 100);
        list-style: none;
        color: white;
    }

    .tblConteudo {
        height: 40px;
        text-align: center;
    }

    .tblConteudo:hover {
        background-color: darkgray;
    }

    .tblConteudo a {
        text-decoration: none;
        color: blueviolet;
        text-transform: uppercase;
    }

    .tblConteudo a:hover {
        color: midnightblue;
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
                    <li><a href="listaTurma.php">TURMAS</a></li>
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
        }
        ?>

        <h2 style="padding: 10px; text-align: center;"><?php echo $turma["nome"] ?></h2>

        <center>
            <div class="tabelaAlunos">

                <table class="tblAluno">
                    <tr class="tblHead">
                        <th>NOME</th>
                        <th>PROFESSOR</th>
                        <th>TURMA</th>
                    </tr>
                    <?php
                    //comando SQL
                    $sql = "SELECT d.nome, d.professor, d.Turma_idTurma, t.idTurma from Disciplina as d INNER JOIN Turma as t on d.Turma_idTurma = t.idTurma where d.Turma_idTurma = $idTurma and t.Escola_idEscola = $idEscola" ;

                    //executar o comando
                    $dados = $conn->query($sql);

                    //se o número de registros retornados for maior que 0
                    if ($dados->num_rows > 0) {
                    ?>
                        <?php
                        while ($exibir = $dados->fetch_assoc()) {
                        ?>
                            <tr class="tblConteudo">
                                <td><?php echo $exibir["nome"] ?></td>
                                <td><?php echo $exibir["professor"] ?></td>
                                <td><?php echo $turma["nome"] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                </table>
            <?php
                    } else {
                        ?>
                        <h4>Nenhum registro encontrado. <strong><a href="formDisciplina.php">Cadastre aqui!</a></strong></h4>
                        <?php
                    }
            ?>
            </div>
        </center>
    <?php } else {
    ?>
        <script>
            alert("FAÇA LOGIN PRIMEIRO");
            window.location = "telaLogin.php";
        </script>
    <?php } ?>
</body>
<script>
    function confirmarExclusao(idAluno, nome) {
        if (window.confirm("Deseja confirmar a exclusão? \n" + idAluno + " - " + nome)) {
            window.location = "excluirAluno.php?idAluno=" + idAluno;
        }
    }
</script>


</html>