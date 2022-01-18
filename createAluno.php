<?php
    //incluir arquivo de conexão com o BD           
    include_once("conexao.php");

    //receber os dados dos form via POST    
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

    //criar comando sql do INSERT
    $sql = "INSERT INTO Aluno (nome, dataNascimento, nomePai, nomeMae, naturalidade, estado, cep, numeroResidencia, telefone, email, senha, Turma_idTurma) VALUES ('$nomeAluno', '$dataNasc', '$nomePai', '$nomeMae', '$naturalidade', '$estado', '$cep', $numero, '$telefone', '$email', '$senha', $turma)";


    //executar o comando SQL
    if ($conn->query($sql) === TRUE) {
    ?>
        <script>
            alert("ALUNO CADASTRADO COM SUCESSO");
            window.location = "listaAluno.php";
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