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
    <title>Portal Escolar - Turmas</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
       h3 {
        padding: 20px;
        margin-top: 10px;
        margin-bottom: 10px;
        background: rgb(21, 40, 100);
        color: whitesmoke;
    }
    .registro a{
        color: springgreen;
    }
     .pag a{
        text-decoration: none;
        text-transform: uppercase;
        color: rgb(21, 40, 100);
        font-size: 20px;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tblTurma {
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
                    <li><a href="formTurma.php">CADASTRO TURMA</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>

        <h2 style="padding: 10px; text-align: center;">LISTA DE TURMAS</h2>

        <center>
            <div class="tabelaTurma">
                <table class="tblTurma">
                    <tr class="tblHead">
                        <th>Nome</th>
                        <th>Série</th>
                        <th>Escola</th>
                        <th>Dados</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                    <?php
                    //comando SQL
                    $sql = "SELECT t.idTurma, t.nome as nomeTurma, t.serie, e.nome as nomeEscola FROM Turma as t INNER JOIN Escola as e on t.Escola_idEscola = e.idEscola WHERE e.idEscola = $idEscola order by nomeTurma";

                    //executar o comando
                    $results_per_page = 10;
                    $dadosTurma = $conn->query($sql);
                    $num_results = $dadosTurma->num_rows;
                    $num_pages = ceil($num_results / $results_per_page);
                    //se o nÃºmero de registros retornados for maior que 0
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }

                    $this_page_first_result = ($page - 1) * $results_per_page;
                    $sql = "SELECT t.idTurma, t.nome as nomeTurma, t.serie, e.nome as nomeEscola FROM Turma as t INNER JOIN Escola as e on t.Escola_idEscola = e.idEscola WHERE e.idEscola = $idEscola  order by nomeTurma limit " . $this_page_first_result . "," . $results_per_page;
                    $dadosTurma = $conn->query($sql);

                    if ($dadosTurma->num_rows > 0) {
                    ?>
                        <?php
                        while ($exibir = $dadosTurma->fetch_array()) {
                        ?>
                            <tr class="tblConteudo">
                                <td> <?php echo $exibir["nomeTurma"] ?></td>
                                <td> <?php echo $exibir["serie"] ?></td>
                                <td> <?php echo $exibir["nomeEscola"] ?></td>
                                <td><a href="listaDisciplinasTurma.php?idTurma=<?php echo $exibir["idTurma"] ?>">Disciplinas</a></td>
                                <td><a href="editarTurma.php?idTurma=<?php echo $exibir["idTurma"] ?>"><i class="fa fa-pencil-square-o" style="font-size:24px"></i></a></td>
                                <td><a href="#" onclick="confirmarExclusao('<?php echo $exibir["idTurma"] ?>', '<?php echo $exibir["nomeTurma"] ?>')"><i class="material-icons">&#xe92b;</i></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                </table>
            <?php
                    } else {
            ?>
                <div class="registro">
                <h3>Nenhum registro encontrado. <a href="formTurma.php">CADASTRE AQUI!</a></h3>
                </div>
            <?php
                    }
                    ?>
                    <div class="pag">
                        <?php
                        for ($page = 1; $page <= $num_pages; $page++) {
                            echo '<a href="listaTurma.php?page=' . $page . '">' . $page . '</a> ';
                        }
                        ?>
                    </div>
                    <?php


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
    function confirmarExclusao(idTurma, nome) {
        if (window.confirm("Deseja confirmar a exclusão? \n" + idTurma + " - " + nome)) {
            window.location = "excluirTurma.php?idTurma=" + idTurma;
        }
    }
</script>

</html>