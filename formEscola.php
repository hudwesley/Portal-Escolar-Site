<?php
require_once("conexao.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wth=device-wth, initial-scale=1.0">
    <title>Portal Escolar - Cadastro</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php 
    if(isset($_SESSION["usuario"])){
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

    <div class="formulario">

        <div class="divCenter">
            <form action="createEscola.php" method="post" class="cadastroEscola">
                <fieldset>
                    <legend style="font-weight: bold;">DADOS DA ESCOLA</legend>

                    <div class="nomeEscola">
                        <label for="nomeEscola">Nome da Escola <label style="color:red">*</label></label><br>
                        <input type="text" name="nomeEscola" maxlength="100" required placeholder="Nome...">
                    </div>

                    <div class="cnpj">
                        <label for="cnpj">CNPJ <label style="color:red">*</label></label><br>
                        <input type="text" name="cnpj" maxlength="18" OnKeyPress="formatar('##.###.###/####-##' ,this)" required placeholder="XX.XXX.XXX/0001-XX">
                    </div>

                    <div class="classificacao">
                        <label for="classificacao">Classificacao <label style="color:red">*</label></label><br>
                        <input type="text" name="classificacao" maxlength="15" required placeholder="Classificação...">
                    </div>

                    <div class="descricao">
                        <label for="descricao">Descrição <label style="color:red">*</label></label><br>
                        <input type="text" name="descricao" maxlength="200" required placeholder="Descrição da Escola...">
                    </div>

                    <div class="status">
                        <label for="status">Status <label style="color:red">*</label></label><br>
                        <input type="text" name="status" maxlength="1" required placeholder="0 ou 1">
                    </div>

                    <div class="logo">
                        <label for="logo">Logo da Escola <label style="color:red">*</label></label><br>
                        <input type="text" name="logo" required placeholder="Logo da Escola">
                    </div><br>

                </fieldset>

                <fieldset>
                    <legend style="font-weight: bold;">ENDEREÇO</legend>
                    <div class="Estado">
                        <label for="estado">Estado <label style="color:red">*</label></label><br>
                        <input type="text" name="estado" maxlength="2" required placeholder="Estado...">
                    </div>

                    <div class="cep">
                        <label for="cep">CEP <label style="color:red">*</label></label><br>
                        <input type="text" name="cep" maxlength="9" OnKeyPress="formatar('#####-###', this)" required placeholder="00000-000">
                    </div>

                    <div class="numero">
                        <label for="numero">Nº <label style="color:red">*</label></label><br>
                        <input type="number" name="numero" maxlength="4" required placeholder="Nº...">
                    </div>


                </fieldset>

                <fieldset>
                    <legend style="font-weight: bold;">CONTATO</legend>
                    <div class="email">
                        <label for="email">E-mail <label style="color:red">*</label></label><br>
                        <input type="text" name="email" required placeholder="escola@portalescolar.com">
                    </div>

                    <div class="telefone">
                        <label for="telefone">Telefone <label style="color:red">*</label></label><br>
                        <input type="text" name="telefone" required placeholder="0000-0000" maxlength="9" OnKeyPress="formatar('####-####', this)">
                    </div>

                    <div class="botoes">
                        <button type="submit" name="btnCadastrar" value="Salvar" id="cadastrar">CADASTRAR</button>
                        <button type="reset" name="btnCancelar" value="Cancelar" id="cancelar">CANCELAR</button>
                    </div>

                </fieldset>
            </form>
            <?php } else {
            ?>
                <script>
                    alert("FAÇA LOGIN PRIMEIRO");
                    window.location = "telaLogin.php";
                </script>
            <?php } ?>
        </div>
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