<?php
    //incluir arquivo de conexão com o BD   
    include_once("conexao.php");

    //receber os dados do form via POST 
    $nomeAdm = $_POST["txtNome"];
    $dataNascimento = $_POST["txtData"];
    $naturalidade = $_POST["txtNaturalidade"];
    $estado = $_POST["txtEstado"];
    $cep = $_POST["txtCep"];
    $numResidencia = $_POST["txtNumero"] ;
    $telefone = $_POST["txtTelefone"];
    $email = $_POST["txtEmail"];
    $cpf = $_POST["txtCpf"];
    $senha = $_POST["txtSenha"];
    $estadoCivil = $_POST["estadoCivil"];
    $escola = $_POST["txtEscola"];
    $sexo = $_POST["sexo"];

    //criar comando sql do INSERT
    $sql = "INSERT INTO AdministradorEscola (nome, dataNascimento, naturalidade, estado, cep, numeroResidencia, telefone, email, cpf, senha, estado_civil, Escola_idEscola, sexo) VALUES ('$nomeAdm', '$dataNascimento', '$naturalidade', '$estado', '$cep', $numResidencia, '$telefone', '$email', '$cpf', '$senha', '$estadoCivil', $escola, '$sexo')";

    //executar comando sql
    if($conn->query($sql) === TRUE){
        ?>
            <script>
                alert("ADMINISTRADOR CADASTRADO COM SUCESSO");
                window.location = "listaAdm.php";
            </script>
        <?php
    }
    else{
        ?>
            <script>
                 alert("ERRO AO CADASTRAR <?php echo($sql);?>");
                 window.history.back();
            </script>
        <?php
    }
?>