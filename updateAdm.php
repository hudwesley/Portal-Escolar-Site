<?php
include_once("conexao.php");

if (isset($_POST["txtNome"])) {
    $idAdministradorEscola = $_GET["idAdministradorEscola"];
    $nome = $_POST["txtNome"];
    $dataNasc = $_POST["txtData"];
    $naturalidade = $_POST["txtNaturalidade"];
    $estado = $_POST["txtEstado"];
    $cep = $_POST["txtCep"];
    $numResidencia = $_POST["txtNumero"];
    $telefone = $_POST["txtTelefone"];
    $email = $_POST["txtEmail"];
    $cpf = $_POST["txtCpf"];
    $senha = $_POST["txtSenha"];
    $estCivil = $_POST["estadoCivil"];
    $escola = $_POST["escola"];
    $sexo = $_POST["sexo"];

    $sql = "UPDATE AdministradorEscola SET nome = '$nome', dataNascimento = '$dataNasc', estado = '$estado', cep = '$cep', numeroResidencia = $numResidencia, telefone = '$telefone', email = '$email', cpf = '$cpf', senha = '$senha', estado_civil = '$estCivil', Escola_idEscola = $escola, sexo = '$sexo' WHERE idAdministradorEscola = $idAdministradorEscola";

    if ($conn->query($sql) === TRUE) {
?>
        <script>
            window.alert("DADOS ATUALIZADOS COM SUCESSO!");
            window.location = "listaAdm.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("ERRO AO EDITAR <?php echo ($sql); ?>");
            window.history.back() = "listaAdm.php";
        </script>
<?php
    }
}

?>