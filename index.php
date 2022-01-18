<?php
require_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Escolar - Escolas</title>
</head>
<style>
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tblEscola {
        margin-bottom: 30px;
        width: 90%;
        border-collapse: collapse;
        padding: 10px;
        text-align: center;
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
        text-transform: uppercase;
    }

    .tblConteudo:hover {
        background-color: darkgray;
    }

    .tblConteudo a {
        text-decoration: none;
        color: blueviolet;
    }

    .tblConteudo a:hover {
        color: midnightblue;
    }
</style>

<body>
    <center>
        <table class="tblEscola">
            <tr class="tblHead">
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Acessar</th>
            </tr>
            <?php
            $sql = "SELECT * FROM Escola ORDER BY nome";

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
                        <td> <?php echo $exibir["telefone"] ?></td>
                        <td> <?php echo $exibir["email"]?></td>
                        <td><a href="home.php?idEscola=<?php echo $exibir["idEscola"] ?>">Acessar</a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </center>
</body>
<script>
    function acessarEscola(idEscola, nome) {
        if (window.confirm("Deseja acessar está escola? \n" + nome)) {
            window.location = "home.php?idEscola=" + idEscola;
        }
    }
</script>
</html>