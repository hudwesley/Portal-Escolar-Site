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
    <title>Portal Escolar - Escolas</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tblEscola {
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
        $idEscola = $_SESSION["idEscola"];
    ?>
        <header>
            <div style="background-color: rgb(21, 40, 100); text-align: center; padding-top: 10px; color: white; font-weight: bold">
                Olá, <?php echo $_SESSION["nomeAdm"]; ?>
            </div>
            <nav id="barraItens">
                <ul>
                    <li><a href="listaEscola.php">ESCOLA</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>

        <h2 style="padding: 10px; text-align: center;"><?php echo $_SESSION["nomeEscola"] ?></h2>

        <center>
            <div class="tabelaEscola">
                <table class="tblEscola">
                    <tr class="tblHead">
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                    <?php
                    //comando SQL
                    $sql = "SELECT * FROM Escola WHERE idEscola = $idEscola order by nome";

                    //executar o comando
                    $dadosEscola = $conn->query($sql);

                    //se o número de registros retornados for maior que 0
                    if ($dadosEscola->num_rows > 0) {
                    ?>
                        <?php
                        while ($exibir = $dadosEscola->fetch_assoc()) {
                        ?>
                            <tr class="tblConteudo">
                                <td> <?php echo $exibir["nome"] ?></td>
                                <td> <?php echo $exibir["email"] ?></td>
                                <td> <?php echo $exibir["telefone"] ?></td>
                                <td><a href="editarEscola.php?idEscola=<?php echo $exibir["idEscola"] ?>"><i class="fa fa-pencil-square-o" style="font-size:24px"></i></a></td>
                                <td><a href="#" onclick="confirmarExclusao('<?php echo $exibir["idEscola"] ?>', '<?php echo $exibir["nome"] ?>')"><i class="material-icons">&#xe92b;</i></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                </table>
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
    function confirmarExclusao(idEscola, nome) {
        if (window.confirm("Deseja confirmar a exclusão? \n" + idEscola + " - " + nome)) {
            window.location = "excluirEscola.php?idEscola=" + idEscola;
        }
    }
</script>

</html>