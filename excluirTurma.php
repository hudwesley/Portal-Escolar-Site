<?php
include_once('conexao.php');
//isset verifica se foi setado algum valor para $_GET["idAluno"]
if (isset($_GET["idTurma"])) {
    $idTurma = $_GET["idTurma"];
    $sql = "DELETE FROM Turma WHERE idTurma = $idTurma";

    try {
        $conn->query($sql);
?>
        <script>
            alert("EXCLUÍDO COM SUCESSO");
            window.location = "listaTurma.php"
        </script>
    <?php
    } catch (Exception $e) {
    ?>
        <script>
            alert("Não foi possível excluir a turma, há registros que dependem dela.");
            window.history.back();
        </script>
<?php
    }
}
?>