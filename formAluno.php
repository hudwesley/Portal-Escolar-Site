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
    if (isset($_SESSION["usuario"])) {
        $idEscola = $_SESSION["idEscola"];
    ?>
        <header>
            <div style="background-color: rgb(21, 40, 100); text-align: center; padding-top: 10px; color: white; font-weight: bold">
                Olá, <?php echo $_SESSION["nomeAdm"]; ?>
            </div>
            <nav id="barraItens">
                <ul>
                    <li><a href="listaAluno.php">LISTA DE ALUNOS</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>
            <div class="formulario">

                <div class="titulo">
                    <h2>Cadastro de Alunos</h2><br>
                </div>
                <div class="divCenter">
                    <form action="createAluno.php" method="post" class="cadastro">
                        <fieldset class="infoPessoais">
                            <legend style="font-weight: bold;"> Dados Pessoais</legend>
                            <div class="nome">
                                <label for="nome">Nome <label style="color:red">*</label></label><br>
                                <input type="text" name="txtNome" required placeholder="Nome...">
                            </div>

                            <div class="dataNascimento">
                                <label for="dataNascimento">Data de Nascimento <label style="color:red">*</label></label><br>
                                <input type="date" name="dataNascimento" required>
                            </div>

                            <div class="nomePai">
                                <label for="nomePai">Nome do Pai <label style="color:red">*</label></label><br>
                                <input type="text" name="txtNomePai" required placeholder="Nome do Pai...">
                            </div>

                            <div class="nomeMae">
                                <label for="nomeMae">Nome da Mãe <label style="color:red">*</label></label><br>
                                <input type="text" name="txtNomeMae" required placeholder="Nome da Mãe...">
                            </div>

                            <div class="telefone">
                                <label for="telefone">Telefone <label style="color:red">*</label></label><br>
                                <input type="text" name="txtTelefone" required maxlength="13" OnKeyPress="formatar('##-#####-####', this)" placeholder="00-90000-0000">
                            </div>

                            <div class="naturalidade">
                                <label for="naturalidade">Naturalidade <label style="color:red">*</label></label><br>
                                <input type="text" name="txtNaturalidade" required placeholder="Naturalidade...">
                            </div>


                        </fieldset>

                        <fieldset class="endereco">
                            <legend  style="font-weight: bold;">Endereco</legend>
                            <div class="estado">
                                <label for="estado">Estado <label style="color:red">*</label></label><br>
                                <input type="text" name="txtEstado" maxlength="2" required placeholder="Estado...">
                            </div>

                            <div class="cep">
                                <label for="cep">CEP <label style="color:red">*</label></label><br>
                                <input type="text" name="txtCep" maxlength="9" OnKeyPress="formatar('#####-###', this)" required placeholder="00000-000">
                            </div>

                            <div class="numero">
                                <label for="numero">Nº <label style="color:red">*</label></label><br>
                                <input type="number" name="numResidencia" required>
                            </div>
                        </fieldset>

                        <fieldset class="infoEscolares">
                            <legend  style="font-weight: bold;">Dados Escolares</legend>

                            <div class="email">
                                <label for="email">E-mail <label style="color:red">*</label></label><br>
                                <input type="email" name="emailAluno" required placeholder="E-mail...">
                            </div>

                            <div class="senha">
                                <label for="senha">Senha <label style="color:red">*</label></label><br>
                                <input type="password" name="senhaAluno" required placeholder="*********"><br>
                            </div>

                            <div class="turma">
                                <label for="turma">Turma <label style="color:red">*</label></label><br>

                                <select name="turma" required>
                                    <option selected disabled value="">ESCOLHA</option>
                                    <?php
                                    include_once("conexao.php");
                                    $sql = "SELECT * FROM Turma WHERE Escola_idEscola = $idEscola order by  nome";

                                    $dadosTurma = $conn->query($sql);

                                    if ($dadosTurma->num_rows > 0) {
                                    ?>
                                        <?php
                                        while ($exibir = $dadosTurma->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $exibir["idTurma"] ?>"><?php echo $exibir["nome"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><br>
                            <div class="botoes">
                                <button type="submit" name="btnCadastrar" value="Salvar" id="cadastrar">CADASTRAR</button>
                                <button type="reset" name="btnCancelar" value="Cancelar" id="cancelar">CANCELAR</button>
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