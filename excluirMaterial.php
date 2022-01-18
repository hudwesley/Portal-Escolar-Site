
<?php
include_once("conexao.php");
if (isset($_GET["idmaterialComplementar"])) {
    $idmaterialComplementar = $_GET["idmaterialComplementar"];
    $sql = "DELETE FROM MaterialComplementar WHERE idmaterialComplementar = $idmaterialComplementar";

    try {
        $conn->query($sql);
?>
        <script>
            alert("EXCLUÍDO COM SUCESSO");
            window.location = "listaMaterial.php"
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