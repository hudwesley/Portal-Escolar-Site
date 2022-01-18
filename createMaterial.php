<?php
    //incluir arquivo de conexão com o BD   
    include_once("conexao.php");

    //receber os dados do form via POST 
    
    $titulo = $_POST["txtTitulo"];
    $conteudo = $_POST["txtConteudo"];
    $dataPublicacao = $_POST["dataSistema"];
    $autor = $_POST["administrador"];


    //criar comando sql do INSERT

    $sql = "INSERT INTO MaterialComplementar (titulo, data, conteudo, Administrador_idAdministrador) VALUES ('$titulo' , '$dataPublicacao', '$conteudo', $autor)";

    //executar comando sql
    if($conn->query($sql) === TRUE){
        ?>
            <script>
                alert("MATERIAL CADASTRADO COM SUCESSO");
                window.location = "listaMaterial.php";
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