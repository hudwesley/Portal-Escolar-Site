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
    <title>Portal Escolar - Administradores</title>
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

    .tblAdm {
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
                    <li><a href="formAdm.php">CADASTRO ADMINISTRADOR</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>

        <h2 style="padding: 10px; text-align: center;">LISTA DE ADMINISTRADORES</h2>


        <center>
            <div class="tabelaAdm">

                <table class="tblAdm">
                    <tr class="tblHead">
                        <th>NOME</th>
                        <th>E-MAIL</th>
                        <th>TELEFONE</th>
                        <th>EDITAR</th>
                        <th>EXCLUIR</th>
                    </tr>
                    <?php
                    //comando SQL
                    $sql = "SELECT * FROM AdministradorEscola WHERE Escola_idEscola = $idEscola order by  nome";

                    //executar o comando
                    $results_per_page = 10;
                    $dadosAdm = $conn->query($sql);
                    $num_results = $dadosAdm->num_rows;
                    $num_pages = ceil($num_results / $results_per_page);
                    //se o número de registros retornados for maior que 0
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }

                    $this_page_first_result = ($page - 1) * $results_per_page;
                    $sql = "SELECT * FROM AdministradorEscola WHERE Escola_idEscola = $idEscola order by  nome limit " . $this_page_first_result . "," . $results_per_page;
                    $dadosAdm = $conn->query($sql);

                    if ($dadosAdm->num_rows > 0) {
                    ?>
                        <?php
                        while ($exibir = $dadosAdm->fetch_assoc()) {
                        ?>
                            <tr class="tblConteudo">
                                <td> <?php echo $exibir["nome"] ?></td>
                                <td> <?php echo $exibir["email"] ?></td>
                                <td> <?php echo $exibir["telefone"] ?></td>
                                <td><a href="editarAdm.php?idAdministradorEscola=<?php echo $exibir["idAdministradorEscola"] ?>"><i class="fa fa-pencil-square-o" style="font-size:24px"></i></a></td>
                                <td><a href="#" onclick="confirmarExclusao('<?php echo $exibir["idAdministradorEscola"] ?>', '<?php echo $exibir["nome"] ?>')"><i class="material-icons">&#xe92b;</i></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                </table>
            <?php
                    } else {
            ?>
                    <h3>Nenhum registro encontrado.. <a href="formAdm.php">Cadastre aqui!</a></h3>
            <?php
                    }
                    for ($page = 1; $page <= $num_pages; $page++) {
                        echo '<a href="listaAdm.php?page=' . $page . '">' . $page . '</a> ';
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
    function confirmarExclusao(idAdministradorEscola, nome) {
        if (window.confirm("Deseja confirmar a exclusão? \n" + idAdministradorEscola + " - " + nome)) {
            window.location = "excluirAdm.php?idAdministradorEscola=" + idAdministradorEscola;
        }
    }
</script>

<script>
    function formatar(mascara, documento) {
        var i = documento.value.length;
        var saida = mascara.substring(0, 1);
        var texto = mascara.substring(i)

        if (texto.substring(0, 1) != saida) {
            documento.value += texto.substring(0, 1);
        }
    }
</script>

</html>