<?php
include_once("conexao.php");

if (isset($_POST["nome"])) {
    $idTurma = $_GET["idTurma"];
    $nome = $_POST["nome"];
    $serie = $_POST["serie"];
    $escola = $_POST["escola"];

    $sql = "UPDATE Turma SET nome = '$nome', serie = '$serie', Escola_idEscola = '$escola' WHERE idTurma = $idTurma";

    if ($conn->query($sql) === TRUE) {
?>
        <script>
            window.alert("DADOS ATUALIZADOS COM SUCESSO!");
            window.location = "listaTurma.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.alert("ERRO AO ATUALIZAR OS DADOS!");
            window.history.back() = "listaTurma.php";
        </script>
<?php
    }
}

?>