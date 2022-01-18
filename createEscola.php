<?php
    include_once('conexao.php');

    $nome = $_POST["nomeEscola"];
    $cep = $_POST["cep"];
    $estado = $_POST["estado"];
    $numero = $_POST["numero"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $cnpj = $_POST["cnpj"];
    $classificacao = $_POST["classificacao"];
    $status = $_POST["status"];
    $descricao = $_POST["descricao"];
    $logo = $_POST["logo"];
    

    $sql = "INSERT INTO Escola (nome, cep, estado, numero, telefone, email, cnpj, classificacao, status, descricao, logo) VALUES ('$nome', '$cep', '$estado', $numero, '$telefone', '$email', '$cnpj', '$classificacao', '$status', '$descricao', '$logo')";


    if ($conn->query($sql) === TRUE) {
        ?>
            <script>
                alert("ESCOLA CADASTRADA COM SUCESSO");
                window.location = "listaEscola.php";
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("ERRO AO CADASTRAR <?php echo($sql);?>");
                window.history.back();
            </script>
        <?php
        }
?>