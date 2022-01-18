<?php
require_once("conexao.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Escolar - Cadastro</title>
    <link rel="stylesheet" href="css/style.css">

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
                    <li><a href="listaAdm.php">LISTA DE ADMINISTRADORES</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>
        <div class="formulario">


            <div class="titulo">
                <h2>Cadastro de Administrador</h2><br>
            </div>
            <div class="divCenter">
                <form action="createAdm.php" method="post" class="cadastro">
                    <fieldset class="infoPessoais">
                        <legend style="font-weight: bold;">Dados Pessoais</legend>
                        <div class="nome">
                            <label for="nome">Nome <label style="color:red">*</label></label><br>
                            <input type="text" name="txtNome" required placeholder="Nome...">
                        </div>

                        <div class="dataNascimento">
                            <label for="dataNascimento">Data de Nascimento <label style="color:red">*</label></label><br>
                            <input type="date" required name="txtData">
                        </div>

                        <div class="naturalidade">
                            <label for="naturalidade">Naturalidade <label style="color:red">*</label></label><br>
                            <input type="text" name="txtNaturalidade" required placeholder="Naturalidade...">
                        </div>

                        <div class="cpf">
                            <label for="cpf">CPF <label style="color:red">*</label></label><br>
                            <input type="text" name="txtCpf" required maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" placeholder="000.000.000-00">
                        </div>

                        <div class="telefone">
                            <label for="telefone">Telefone <label style="color:red">*</label></label><br>
                            <input type="text" name="txtTelefone" required maxlength="13" OnKeyPress="formatar('##-#####-####', this)" placeholder="00-90000-0000">
                        </div>

                        <div class="estadoCivil">
                            <label for="estadoCivil">Estado Civil <label style="color:red">*</label></label><br>
                            <select name="estadoCivil" required>
                                <option selected disabled value="">ESCOLHA</option>
                                <option value="SOLTEIRO (A)">SOLTEIRO (A)</option>
                                <option value="CASADO (A)">CASADO (A)</option>
                                <option value="VIUVO (A)">VIÚVO (A)</option>
                                <option value="DIVORCIADO (A)">DIVORCIADO (A)</option>
                                <option value="SEPARADO (A)">SEPARADO (A)</option>
                            </select>
                        </div>

                        <div class="sexo">
                            <label for="sexo">Sexo</label><br>
                            <select name="sexo">
                                <option selected disabled value="">ESCOLHA</option>
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="FEMININO">FEMININO</option>
                            </select>
                        </div>
                    </fieldset>

                    <fieldset class="endereco">
                        <legend style="font-weight: bold;">Endereco</legend>


                        <div class="estado">
                            <label for="estado">Estado <label style="color:red">*</label></label><br>
                            <input type="text" name="txtEstado" maxlength="2" required placeholder="Estado...">
                        </div>

                        <div class="cep">
                            <label for="cep">CEP <label style="color:red">*</label></label><br>
                            <input type="text" name="txtCep" required maxlength="9" OnKeyPress="formatar('#####-###', this)" placeholder="00000-000">
                        </div>

                        <div class="numero">
                            <label for="numero">Nº <label style="color:red">*</label></label><br>
                            <input type="number" required name="txtNumero">
                        </div>

                    </fieldset>

                    <fieldset class="infoEscolares">
                        <legend style="font-weight: bold;">Dados Escolares</legend>

                        <div class="email">
                            <label for="email">E-mail <label style="color:red">*</label></label><br>
                            <input type="email" name="txtEmail" required placeholder="E-mail...">
                        </div>

                        <div class="senha">
                            <label for="senha">Senha <label style="color:red">*</label></label><br>
                            <input type="password" name="txtSenha" required placeholder="*********"><br>
                        </div>

                        <div class="escola">
                            <label for="escola">Escola <label style="color:red">*</label></label><br>
                            <select name="txtEscola" required>
                                <option value="<?php echo $_SESSION["idEscola"] ?>"><?php echo $_SESSION["nomeEscola"] ?></option>
                            </select>
                        </div><br>

                        <div class="botoes">
                            <button type="submit" id="cadastrar">CADASTRAR</button>
                            <button type="reset" id="cancelar">CANCELAR</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    <?php } else {
    ?>
        <script>
            alert("FAÇA LOGIN PRIMEIRO");
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