<?php
//incluir arquivo de conexão com o BD   
include_once("conexao.php");

//receber os dados do form via POST 
if (isset($_POST["txtTitulo"])) {
    $idMaterial = $_GET["idmaterialComplementar"];
    $titulo = $_POST["txtTitulo"];
    $conteudo = $_POST["txtConteudo"];
    $dataPublicacao = $_POST["dataSistema"];
    $autor = $_POST["administrador"];

    $sql = "UPDATE MaterialComplementar SET titulo = '$titulo', conteudo = '$conteudo', data = '$dataPublicacao', Administrador_idAdministrador = $autor WHERE idmaterialComplementar = $idMaterial";

    if ($conn->query($sql) === TRUE) {
?>
        <script>
            window.alert("MATERIAL COMPLEMENTAR ATUALIZADO COM SUCESSO!");
            window.location = "listaMaterial.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.alert("ERRO AO ATUALIZAR MATERIAL COMPLEMENTAR!");
            window.history.back() = "listaMaterial.php";
        </script>
<?php
    }
}

?>