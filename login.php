<?php
    require_once("conexao.php");
    session_start(); //inicia a sessão
    //receber e-mail e senha vindo da tabela
    $email = $conn->real_escape_string($_POST["txtEmail"]);
    $senha = $_POST["txtSenha"];
    $sql = "SELECT ae.idAdministradorEscola, ae.nome, ae.email, ae.senha, ae.Escola_idEscola, e.nome as nomeE, e.idEscola FROM AdministradorEscola as ae INNER JOIN Escola as e on ae.Escola_idEscola = e.idEscola WHERE ae.email = '$email' and ae.senha = '$senha'";


    $resultado = $conn->query($sql);


    if ($resultado->num_rows > 0) {
        $dados = $resultado->fetch_assoc();
        //preencher a session com os dados do adm
        $_SESSION["usuario"] = $dados["email"];
        $_SESSION["nomeAdm"] = $dados["nome"];
        $_SESSION["idEscola"] = $dados["Escola_idEscola"];
        $_SESSION["idAdministrador"] = $dados["idAdministradorEscola"];
        $_SESSION["nomeEscola"] = $dados["nomeE"];
        
        header("location: homeLogin.php");
    } else {
    ?>
        <script>
            alert("DADOS DE LOGIN INCORRETOS");
            window.history.back();
        </script>
    <?php
}
?>