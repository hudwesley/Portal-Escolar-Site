<?php
    //incluir arquivo de conexão com o BD   
    include_once("conexao.php");

    //receber os dados do form via POST 
    
    $titulo = $_POST["txtTitulo"];
    $conteudo = $_POST["txtConteudo"];
    //$imagem = $_POST["imagem"];
    $dataPublicacao = $_POST["dataSistema"];
    $autor = $_POST["administrador"];


    //criar comando sql do INSERT

    $sql = "INSERT INTO Informativo (titulo, data, conteudo, curtidas, Administrador_idAdministrador) VALUES ('$titulo' , '$dataPublicacao', '$conteudo', 0, $autor)";

    //executar comando sql
    if($conn->query($sql) === TRUE){
        ?>
            <script>
                alert("INFORMATIVO CADASTRADO COM SUCESSO");
                window.location = "listaInformativo.php";
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