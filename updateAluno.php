<?php
include_once("conexao.php");
if (isset($_POST["txtNome"])) {
    $idAluno = $_GET["idAluno"];
    $nomeAluno = $_POST["txtNome"];
    $dataNasc = $_POST["dataNascimento"];
    $nomePai = $_POST["txtNomePai"];
    $nomeMae = $_POST["txtNomeMae"];
    $naturalidade = $_POST["txtNaturalidade"];
    $estado = $_POST["txtEstado"];
    $cep = $_POST["txtCep"];
    $numero = $_POST["numResidencia"];
    $telefone = $_POST["txtTelefone"];
    $email = $_POST["emailAluno"];
    $senha = $_POST["senhaAluno"];
    $turma = $_POST["turma"];

    $sql = "UPDATE Aluno SET nome = '$nomeAluno', dataNascimento = '$dataNasc', nomePai = '$nomePai', nomeMae = '$nomeMae', naturalidade = '$naturalidade', estado = '$estado', cep = '$cep', numeroResidencia = $numero, telefone = '$telefone', email = '$email', senha = '$senha', Turma_idTurma = $turma WHERE idAluno = $idAluno";

    if ($conn->query($sql) === TRUE) {
?>
        <script>
            window.alert("DADOS ATUALIZADOS COM SUCESSO!");
            window.location = "listaAluno.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.alert("ERRO AO ATUALIZAR OS DADOS!");
            window.history.back() = "listaAluno.php";
        </script>
<?php
    }
}

?>