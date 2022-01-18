<?php
    include_once("conexao.php");
    $nomeDisciplina = $_POST["nome"];
    $professorDisciplina = $_POST["professor"];
    $serieDisciplina = $_POST["serie"];
    $turmaDisciplina = $_POST["turma"];

    $sql = "INSERT INTO Disciplina(nome, professor, serie, Turma_idTurma) VALUES('$nomeDisciplina', '$professorDisciplina', '$serieDisciplina', $turmaDisciplina)";

    if($conn->query($sql) === TRUE){
        ?>
            <script>
                alert("DISCIPLINA CADASTRADA COM SUCESSO");
                window.location = "listaDisciplina.php";
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