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
    <title>Portal Escolar - Alunos</title>
    <link rel="stylesheet" href="css/material.css">
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
                    <li><a href="formAluno.php">CADASTRO ALUNO</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>

        <h2 style="padding: 10px; text-align: center;">LISTA DE ALUNOS</h2>

        <center>
            <div class="tabelaAlunos">

                <table class="tblAluno">
                    <tr class="tblHead">
                        <th>NOME</th>
                        <th>E-MAIL</th>
                        <th>TURMA</th>
                        <th>EDITAR</th>
                        <th>EXCLUIR</th>
                    </tr>
                    <?php
                    //comando SQL
                    $sql = "SELECT a.idAluno, a.nome as nomeAluno, a.email, t.nome as nomeTurma FROM Aluno as a INNER JOIN Turma as t on a.Turma_idTurma=t.idTurma WHERE t.Escola_idEscola = $idEscola order by  nomeAluno, nomeTurma";

                    //executar o comando
                    $results_per_page = 10;
                    $dadosAluno = $conn->query($sql);
                    $num_results = $dadosAluno->num_rows;
                    $num_pages = ceil($num_results/$results_per_page);

                    //se o número de registros retornados for maior que 0
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    }
                    else{
                        $page = $_GET['page'];
                    }
                    
                    $this_page_first_result = ($page-1)*$results_per_page;
                    $sql = "SELECT a.idAluno, a.nome as nomeAluno, a.email, t.nome as nomeTurma FROM Aluno as a INNER JOIN Turma as t on a.Turma_idTurma=t.idTurma WHERE t.Escola_idEscola = $idEscola order by  nomeAluno, nomeTurma limit ".$this_page_first_result.",".$results_per_page;
                    $dadosAluno = $conn->query($sql);

                    if ($dadosAluno->num_rows > 0) {
                    ?>
                        <?php
                        while ($exibir = $dadosAluno->fetch_assoc()) {
                        ?>
                            <tr class="tblConteudo">
                                <td><?php echo $exibir["nomeAluno"] ?></td>
                                <td><?php echo $exibir["email"] ?></td>
                                <td><?php echo $exibir["nomeTurma"]?></td>
                                <td><a href="editarAluno.php?idAluno=<?php echo $exibir["idAluno"] ?>"><i class="fa fa-pencil-square-o" style="font-size:24px"></i></a></td>
                                <td><a href="#" onclick="confirmarExclusao('<?php echo $exibir["idAluno"] ?>', '<?php echo $exibir["nomeAluno"] ?>')"><i class="material-icons">&#xe92b;</i></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                </table>
            <?php
                    } else {
                        ?>
                            <div class="alert alert-info">
                                <h3>Nenhum registro encontrado. <a href="formAluno.php">Cadastre aqui!</a></h3>
                            </div>
                        <?php
                        }
                    for($page=1;$page<=$num_pages;$page++){
                        echo '<a href="listaAluno.php?page=' . $page . '">' . $page . '</a> ';
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