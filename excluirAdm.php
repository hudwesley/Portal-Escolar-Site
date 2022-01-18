<?php
include_once('conexao.php');

if (isset($_GET["idAdministradorEscola"])) {
    $idAdministradorEscola = $_GET["idAdministradorEscola"];
    $sql = "DELETE FROM AdministradorEscola WHERE idAdministradorEscola = $idAdministradorEscola";


    try {
        $conn->query($sql);
?>
        <script>
            alert("EXCLUÍDO COM SUCESSO");
            window.location = "listaAdm.php"
        </script>
    <?php
    } catch (Exception $e) {
    ?>
        <script>
            alert("Não foi possível excluir o administrador, há registros que dependem dele.");
            window.history.back();
        </script>
<?php
    }
}
?>