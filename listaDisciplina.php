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
     a{
        text-decoration: none;
        text-transform: uppercase;
        color: springgreen;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tblDisciplina {
        margin-top: 10px;
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
        $nomeAdm = $_SESSION["nomeAdm"];
        $idEscola = $_SESSION["idEscola"];
    ?>
        <header>
            <div style="background-color: rgb(21, 40, 100); text-align: center; padding-top: 10px; color: white; font-weight: bold">
                Olá, <?php echo $_SESSION["nomeAdm"]; ?>
            </div>
            <nav id="barraItens">
                <ul>
                    <li><a href="formDisciplina.php">CADASTRO DISCIPLINA</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>

        <h2 style="padding-top: 10px; text-align: center;">LISTA DE DISCIPLINAS</h2>
 
        <center>
            <div class="tabelaDisciplina">
                <table class="tblDisciplina">
                    <tr class="tblHead">
                        <th>Nome</th>
                        <th>Professor</th>
                        <th>Série</th>
                        <th>Turma</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                    <?php
                    //comando SQL
                    $sql = "SELECT d.idDisciplinas, d.nome as nomeDisciplina, d.professor, t.nome as nomeTurma, d.serie  FROM Disciplina as d INNER JOIN AdministradorEscola as ae on d.professor = ae.nome INNER JOIN Turma as t on d.Turma_idTurma = t.idTurma WHERE ae.nome = '$nomeAdm' and t.Escola_idEscola = $idEscola ORDER BY serie, nomeDisciplina";

                    //executar o comando
                    $results_per_page = 10;
                    $dadosDisciplina = $conn->query($sql);
                    $num_results = $dadosDisciplina->num_rows;
                    $num_pages = ceil($num_results / $results_per_page);

                    //se o número de registros retornados for maior que 0
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }

                    $this_page_first_result = ($page - 1) * $results_per_page;
                    $sql = "SELECT d.idDisciplinas, d.nome as nomeDisciplina, d.professor, t.nome as nomeTurma, d.serie  FROM Disciplina as d INNER JOIN AdministradorEscola as ae on d.professor = ae.nome INNER JOIN Turma as t on d.Turma_idTurma = t.idTurma WHERE ae.nome = '$nomeAdm' and t.Escola_idEscola = $idEscola ORDER BY serie, nomeDisciplina, nomeTurma limit " . $this_page_first_result . "," . $results_per_page;
                    $dadosDisciplina = $conn->query($sql);

                    if ($dadosDisciplina->num_rows > 0) {
                    ?>
                        <?php
                        while ($exibir = $dadosDisciplina->fetch_assoc()) {
                        ?>
                            <tr class="tblConteudo">
                                <td> <?php echo $exibir["nomeDisciplina"] ?></td>
                                <td> <?php echo $exibir["professor"] ?></td>
                                <td> <?php echo $exibir["serie"] ?></td>
                                <td> <?php echo $exibir["nomeTurma"] ?></td>
                                <td><a href="editarDisciplina.php?idDisciplinas=<?php echo $exibir["idDisciplinas"] ?>"><i class="fa fa-pencil-square-o" style="font-size:24px"></i></a></td>
                                <td><a href="#" onclick="confirmarExclusao('<?php echo $exibir["idDisciplinas"] ?>', '<?php echo $exibir["nomeDisciplina"] ?>')"><i class="material-icons">&#xe92b;</i></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                </table>
            <?php
                    } else {
            ?>
                <h3>Nenhum registro encontrado. <a href="formDisciplina.php">Cadastre aqui!</a></h3>
            <?php
                    }
                    for ($page = 1; $page <= $num_pages; $page++) {
                        echo '<a href="listaDisciplina.php?page=' . $page . '">' . $page . '</a> ';
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
    function confirmarExclusao(idDisciplinas, nome) {
        if (window.confirm("Deseja confirmar a exclusão? \n" + idDisciplinas + " - " + nome)) {
            window.location = "excluirDisciplina.php?idDisciplinas=" + idDisciplinas;
        }
    }
</script>

</html>