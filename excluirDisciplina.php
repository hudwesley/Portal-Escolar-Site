<?php
include_once('conexao.php');

//isset verifica se foi setado algum valor para $_GET["idAluno"]
if (isset($_GET["idDisciplinas"])) {
    $idDisciplinas = $_GET["idDisciplinas"];
    $sql = "DELETE FROM Disciplina WHERE idDisciplinas = $idDisciplinas";

    try {
        $conn->query($sql);
?>
        <script>
            alert("EXCLUÍDO COM SUCESSO");
            window.location = "listaDisciplina.php"
        </script>
    <?php
    } catch (Exception $e) {
    ?>
        <script>
             alert("ERRO AO EXCLUIR");
            window.history.back();
        </script>
<?php
    }
}
?>