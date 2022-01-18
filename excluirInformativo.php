<?php
include_once("conexao.php");
if (isset($_GET["idInformativo"])) {
    $idInformativo = $_GET["idInformativo"];
    $sql = "DELETE FROM Informativo WHERE idInformativo = $idInformativo";

    try {
        $conn->query($sql);
?>
        <script>
            alert("EXCLUÍDO COM SUCESSO");
            window.location = "listaInformativo.php"
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