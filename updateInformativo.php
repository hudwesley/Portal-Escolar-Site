<?php
//incluir arquivo de conexão com o BD   
include_once("conexao.php");

//receber os dados do form via POST 
if (isset($_POST["txtTitulo"])) {
    $idInformativo = $_GET["idInformativo"];
    $titulo = $_POST["txtTitulo"];
    $conteudo = $_POST["txtConteudo"];
    $dataPublicacao = $_POST["dataSistema"];
    $autor = $_POST["administrador"];

    $sql = "UPDATE Informativo SET titulo = '$titulo', data = '$dataPublicacao', conteudo = '$conteudo', Administrador_idAdministrador = $autor WHERE idInformativo = $idInformativo";

    if ($conn->query($sql) === TRUE) {
?>
        <script>
            window.alert("INFORMATIVO ATUALIZADO COM SUCESSO!");
            window.location = "listaInformativo.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.alert("ERRO AO ATUALIZAR INFORMATIVO!");
            window.history.back() = "listaInformativo.php";
        </script>
<?php
    }
}

?>