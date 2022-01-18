<?php
include_once("conexao.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Escolar - Editar</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php
    if (isset($_SESSION["usuario"])) {
        $escola = $_SESSION["idEscola"];
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

        <?php
        if (isset($_GET["idAdministradorEscola"])) {
            $idAdministradorEscola = $_GET["idAdministradorEscola"];
            $sql = "SELECT * FROM AdministradorEscola WHERE idAdministradorEscola = $idAdministradorEscola";
            $consulta = $conn->query($sql);
            $administrador = $consulta->fetch_assoc();

        ?>


            <div class="formulario">
                <div class="titulo">
                    <h2><?php echo $administrador["nome"] ?></h2><br>
                </div>
                <div class="divCenter">
                    <form action="updateAdm.php?idAdministradorEscola=<?php echo $_GET['idAdministradorEscola'] ?>" method="post" class="cadastro">
                        <fieldset class="infoPessoais">
                            <legend style="font-weight: bold;">Dados Pessoais</legend>
                            <div class="nome">
                                <label for="nome">Nome <label style="color:red">*</label></label><br>
                                <input type="text" name="txtNome" required value="<?php echo $administrador["nome"] ?>">
                            </div>

                            <div class="dataNascimento">
                                <label for="dataNascimento">Data de Nascimento <label style="color:red">*</label></label><br>
                                <input type="date" required name="txtData" value="<?php echo $administrador["dataNascimento"] ?>">
                            </div>

                            <div class="naturalidade">
                                <label for="naturalidade">Naturalidade <label style="color:red">*</label></label><br>
                                <input type="text" name="txtNaturalidade" required value="<?php echo $administrador["naturalidade"] ?>">
                            </div>

                            <div class="cpf">
                                <label for="cpf">CPF <label style="color:red">*</label></label><br>
                                <input type="text" name="txtCpf" required value="<?php echo $administrador["cpf"] ?>" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)">
                            </div>

                            <div class="telefone">
                                <label for="telefone">Telefone <label style="color:red">*</label></label><br>
                                <input type="text" name="txtTelefone" required value="<?php echo $administrador["telefone"] ?>" maxlength="13" OnKeyPress="formatar('##-#####-####', this)">
                            </div>

                            <div class="estadoCivil">
                                <label for="estadoCivil">Estado Civil <label style="color:red">*</label></label><br>
                                <select name="estadoCivil" required>
                                    <option value="<?php echo $administrador["estado_civil"] ?>"> <?php echo $administrador["estado_civil"] ?></option>
                                    <option value="SOLTEIRO (A)">SOLTEIRO (A)</option>
                                    <option value="CASADO (A)">CASADO (A)</option>
                                    <option value="VIUVO (A)">VIÚVO (A)</option>
                                    <option value="DIVORCIADO (A)">DIVORCIADO (A)</option>
                                    <option value="SEPARADO (A)">SEPARADO (A)</option>
                                </select>
                            </div>

                            <div class="sexo">
                                <label for="sexo">Sexo</label><br>
                                <select name="sexo" required>
                                    <option value="<?php echo $administrador["sexo"] ?>"> <?php echo $administrador["sexo"] ?> </option>
                                    <option value="MASCULINO">MASCULINO</option>
                                    <option value="FEMININO">FEMININO</option>
                                </select>
                            </div>
                        </fieldset>

                        <fieldset class="endereco">
                            <legend style="font-weight: bold;">Endereco</legend>
                            <div class="estado">
                                <label for="estado">Estado <label style="color:red">*</label></label><br>
                                <input type="text" name="txtEstado" required value="<?php echo $administrador["estado"] ?>" maxlength="2">
                            </div>

                            <div class="cep">
                                <label for="cep">CEP <label style="color:red">*</label></label><br>
                                <input type="text" name="txtCep" required value="<?php echo $administrador["cep"] ?>" maxlength="9" OnKeyPress="formatar('#####-###', this)">
                            </div>

                            <div class="numero">
                                <label for="numero">Nº <label style="color:red">*</label></label><br>
                                <input type="number" required name="txtNumero" value="<?php echo $administrador["numeroResidencia"] ?>">
                            </div>
                        </fieldset>

                        <fieldset class="infoEscolares">
                            <legend style="font-weight: bold;">Dados Escolares</legend>

                            <div class="email">
                                <label for="email">E-mail <label style="color:red">*</label></label><br>
                                <input type="email" name="txtEmail" required value="<?php echo $administrador["email"] ?>">
                            </div>

                            <div class="senha">
                                <label for="senha">Senha <label style="color:red">*</label></label><br>
                                <input type="password" name="txtSenha" required value="<?php echo $administrador["senha"] ?>">
                            </div>

                            <div class="escola">
                                <label for="escola">Escola <label style="color:red">*</label></label><br>
                                <select name="escola" required>
                                    <?php
                                    include_once("conexao.php");
                                    $sql = "SELECT idEscola, nome FROM Escola WHERE idEscola = $escola";

                                    $escola = $conn->query($sql);
                                    while ($rowEscola = $escola->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $rowEscola["idEscola"]; ?>" <?php echo ($rowEscola["idEscola"] == $administrador["Escola_idEscola"]) ? "selected" : "" ?>> <?php echo $rowEscola["nome"] ?> </option>
                                <?php
                                    }
                                } else{
                                    ?>
                                    <script>
                                        alert("ESCOLHA UM ADMINISTRADOR PRIMEIRO!");
                                        window.location = "listaAdm.php";
                                    </script>
                                    <?php
                                }
                                ?>
                                </select>
                            </div><br>

                            <div class="botoes">
                                <button type="submit" id="cadastrar">SALVAR</button>
                                <button type="reset" id="cancelar">CANCELAR</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        <?php } else {
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