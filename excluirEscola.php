<?php
include_once('conexao.php');

//isset verifica se foi setado algum valor para $_GET["idAluno"]
if (isset($_GET["idEscola"])) {
    $idEscola = $_GET["idEscola"];
    $sql = "DELETE FROM Escola WHERE idEscola = $idEscola";

    try {
        $conn->query($sql);
?>
        <script>
            alert("EXCLUÍDO COM SUCESSO");
            window.location = "listaEscola.php"
        </script>
    <?php
    } catch (Exception $e) {
    ?>
        <script>
            alert("Não foi possível excluir a escola, há registros que dependem dela.");
            window.history.back();
        </script>
<?php
    }
}
?>