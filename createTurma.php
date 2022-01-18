<?php
    include_once("conexao.php");
    $nomeTurma = $_POST["txtNome"];
    $serieTurma = $_POST["txtSerie"];
    $escolaTurma = $_POST["txtEscola"];

    $sql = "INSERT INTO Turma(nome, serie, Escola_idEscola) VALUES('$nomeTurma', '$serieTurma', $escolaTurma)";

    if($conn->query($sql) === TRUE){
        ?>
            <script>
                alert("TURMA CADASTRADA COM SUCESSO");
                window.location = "listaTurma.php";
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