<?php
include_once("conexao.php");
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wth=device-wth, initial-scale=1.0">
    <title>Portal Escolar - Editar</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/formatar.js">

</head>

<body>
    <?php
    if (isset($_SESSION["usuario"])) {

    ?>
        <header>
            <div style="background-color: rgb(21, 40, 100); text-align: center; padding-top: 10px; color: white; font-weight: bold">
                Olá, <?php echo $_SESSION["nomeAdm"]; ?>
            </div>
            <nav id="barraItens">
                <ul>
                    <li><a href="listaEscola.php">LISTA DE ESCOLAS</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>

        <?php
        if (isset($_GET["idEscola"])) {
            $idEscola = $_GET["idEscola"];
            $sql = "SELECT * FROM Escola WHERE idEscola = $idEscola";
            $consulta = $conn->query($sql);
            $escola = $consulta->fetch_assoc();

        ?>

            <div class="formulario">
                <div class="titulo">
                    <h2><?php echo $escola["nome"] ?></h2><br>
                </div>
                <div class="divCenter">
                    <form action="updateEscola.php?idEscola=<?php echo $_GET['idEscola'] ?>" method="post" class="cadastroEscola">
                        <fieldset>
                            <legend style="font-weight: bold;">DADOS DA ESCOLA</legend>
                            <div class="nomeEscola">
                                <label for="nomeEscola">Nome da Escola <label style="color:red">*</label></label><br>
                                <input type="text" name="nomeEscola" value="<?php echo $escola["nome"] ?>">
                            </div>

                            <div class="cnpj">
                                <label for="cnpj">CNPJ <label style="color:red">*</label></label><br>
                                <input type="text" name="cnpj" value="<?php echo $escola["cnpj"] ?>" maxlength="18" OnKeyPress="formatar('##.###.###/####-##' ,this)">
                            </div>

                            <div class="classificacao">
                                <label for="classificacao">Classificacao <label style="color:red">*</label></label><br>
                                <input type="text" name="classificacao" maxlength="15" value="<?php echo $escola["classificacao"] ?>">
                            </div>

                            <div class="status">
                                <label for="status">Status <label style="color:red">*</label></label><br>
                                <input type="text" name="status" maxlength="1" value="<?php echo $escola["status"] ?>">
                            </div>

                            <div class="descricao">
                                <label for="descricao">Descrição <label style="color:red">*</label></label><br>
                                <input type="text" name="descricao" value="<?php echo $escola["descricao"] ?>">
                            </div>

                            <div class="logo">
                                <label for="logo">Logo da Escola <label style="color:red">*</label></label><br>
                                <input type="text" name="logo" value="<?php echo $escola["logo"] ?>">
                            </div><br>

                        </fieldset>
                        <fieldset>
                            <legend style="font-weight: bold;">ENDEREÇO</legend>
                            <div class="Estado">
                                <label for="estado">Estado <label style="color:red">*</label></label><br>
                                <input type="text" name="estado" maxlength="2" value="<?php echo $escola["estado"] ?>">
                            </div>
                            <div class="cep">
                                <label for="cep">CEP <label style="color:red">*</label></label><br>
                                <input type="text" name="cep" value="<?php echo $escola["cep"] ?>" maxlength="9" OnKeyPress="formatar('#####-###', this)">
                            </div>
                            <div class="numero">
                                <label for="numero">Nº <label style="color:red">*</label></label><br>
                                <input type="number" name="numero" maxlength="4" value="<?php echo $escola["numero"] ?>">
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend style="font-weight: bold;">CONTATO</legend>
                            <div class="telefone">
                                <label for="telefone">Telefone <label style="color:red">*</label></label><br>
                                <input type="text" name="telefone" maxlength="9" OnKeyPress="formatar('####-####', this)" value="<?php echo $escola["telefone"] ?>">
                            </div>

                            <div class="email">
                                <label for="email">E-mail <label style="color:red">*</label></label><br>
                                <input type="text" name="email" value="<?php echo $escola["email"] ?>">
                            </div>

                            <div class="botoes">
                                <button type="submit" name="btnCadastrar" value="Salvar" id="cadastrar">SALVAR</button>
                                <button type="reset" name="btnCancelar" value="Cancelar" id="cancelar">CANCELAR</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        <?php } else {
        ?>
            <script>
                alert("ESCOLHA UMA ESCOLA PRIMEIRO!");
                window.location = "listaEscola.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("PARA UTILIZAR OS RECURSOS, PRIMEIRO FAÇA LOGIN");
            window.location = "telaLogin.php";
        </script>
    <?php } ?>
</body>
<script>
    function formatar(mascara, documento) {
        var i = documento.value.length;
        var saida = mascara.substring(0, 1);
        var texto = mascara.substring(i)

        if (texto.substring(0, 1) != saida) {
            documento.value += texto.substring(0, 1);
        }
    }
</script>

</html>