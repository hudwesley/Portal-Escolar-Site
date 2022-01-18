<?php
include_once("conexao.php");

if (isset($_POST["nomeEscola"])) {
    $idEscola = $_GET["idEscola"];
    $nomeEscola = $_POST["nomeEscola"];
    $cep = $_POST["cep"];
    $estado = $_POST["estado"];
    $numero = $_POST["numero"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $cnpj = $_POST["cnpj"];
    $classificacao = $_POST["classificacao"];
    $status = $_POST["status"];
    $descricao = $_POST["descricao"];
    $logo = $_POST["logo"];

    $sql = "UPDATE Escola SET nome = '$nomeEscola', cep = '$cep', estado = '$estado', numero = $numero, telefone = '$telefone', email = '$email', cnpj = '$cnpj', classificacao = '$classificacao', status = '$status', descricao = '$descricao', logo = '$logo' WHERE idEscola = $idEscola";

    if ($conn->query($sql) === TRUE) {
?>
        <script>
            window.alert("DADOS ATUALIZADOS COM SUCESSO!");
            window.location = "listaEscola.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.alert("ERRO AO ATUALIZAR OS DADOS!");
            window.history.back() = "listaEscola.php";
        </script>
<?php
    }
}

?>