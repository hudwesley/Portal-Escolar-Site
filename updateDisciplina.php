<?php
include_once("conexao.php");

if (isset($_POST["nome"])) {
    $idDisciplinas = $_GET["idDisciplinas"];
    $nome = $_POST["nome"];
    $professor = $_POST["professor"];
    $serie = $_POST["serie"];
    $turma = $_POST["turma"];

    $sql = "UPDATE Disciplina SET nome = '$nome', professor = '$professor', serie = '$serie', Turma_idTurma = '$turma' WHERE idDisciplinas = $idDisciplinas";

    if ($conn->query($sql) === TRUE) {
?>
        <script>
            window.alert("DADOS ATUALIZADOS COM SUCESSO!");
            window.location = "listaDisciplina.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.alert("ERRO AO ATUALIZAR OS DADOS!");
            window.history.back() = "listaDisciplina.php";
        </script>
<?php
    }
}

?>