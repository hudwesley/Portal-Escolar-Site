<?php
include_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<style>
    label {
        font-weight: bold;
    }

    a {
        text-decoration: none;
        color: blueviolet;
    }
</style>

<body>
    <?php
    if (isset($_GET["idEscola"])) {
        $idEscola = $_GET["idEscola"];
        $sql = "SELECT * FROM Escola WHERE idEscola = $idEscola";
        $consulta = $conn->query($sql);
        $escola = $consulta->fetch_assoc();
    }
    ?>
    <header>
        <nav id="barraItens">
            <ul style="height: 60px;">
                <li><a href="#"></a></li>
                <li><a href="home.php?idEscola=<?php echo $escola["idEscola"] ?>">HOME</a></li>
            </ul>
        </nav>
    </header>
    <center>
        <div class="container" style="font-size: 20px; color: black; margin-top: 20px;">

            <div class="coluna1">
                <div class="detalheLogin">
                    <h2 style="color: white; position: relative; top: 42%;">Bem vindo!</h2>
                </div>
            </div>

            <fieldset class="loginUsuario">
                <br><br><br><br>
                <form action="login.php" method="post">

                    <div class="email">
                        <label for="nome">Usuário</label><br>
                        <input type="email" name="txtEmail" required placeholder="Informe o e-mail...">
                    </div>
                    <br>
                    <div class="senha">
                        <label for="nome">Senha</label><br>
                        <input type="password" name="txtSenha" required placeholder="Informe a senha...">
                    </div>

                    <br>

                    <div class="botoes">
                        <button type="submit" name="btnCadastrar" value="Salvar" id="cadastrar">ENTRAR</button>
                        <button type="reset" name="btnCancelar" value="Cancelar" id="cancelar">CANCELAR</button>
                    </div>
                </form>
                <b>
                    <p style="position: relative; top: 10%;">Não sabe sua conta? <a href="mailto:<?php echo $escola["email"] ?>?subject=Login de usuário">Entre em contato com a escola!</a></p>
                </b>
            </fieldset>

        </div>

    </center>

</body>

</html>