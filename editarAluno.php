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
                    <li><a href="listaAluno.php">LISTA DE ALUNOS</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>

        <?php
        if (isset($_GET["idAluno"])) {
            $idAluno = $_GET["idAluno"];
            $sql = "SELECT * FROM Aluno WHERE idAluno = $idAluno";
            $consulta = $conn->query($sql);
            $aluno = $consulta->fetch_assoc();
        
        ?>
        <div class="formulario">

            <div class="titulo">
                <h2><?php echo $aluno["nome"] ?></h2><br>
            </div>

            <div class="divCenter">
                <form action="updateAluno.php?idAluno=<?php echo $_GET['idAluno'] ?>" method="post" class="cadastro">
                    <fieldset class="infoPessoais">
                        <legend style="font-weight: bold;">Dados Pessoais</legend>
                        <div class="nome">
                            <label for="nome">Nome <label style="color:red">*</label></label><br>
                            <input type="text" name="txtNome" required value="<?php echo $aluno["nome"] ?>">
                        </div>

                        <div class="dataNascimento">
                            <label for="dataNascimento">Data de Nascimento <label style="color:red">*</label></label><br>
                            <input type="date" name="dataNascimento" required value="<?php echo $aluno["dataNascimento"] ?>">
                        </div>

                        <div class="nomePai">
                            <label for="nomePai">Nome do Pai <label style="color:red">*</label></label><br>
                            <input type="text" name="txtNomePai" required required value="<?php echo $aluno["nomePai"] ?>">
                        </div>

                        <div class="nomeMae">
                            <label for="nomeMae">Nome da Mãe <label style="color:red">*</label></label><br>
                            <input type="text" name="txtNomeMae" required value="<?php echo $aluno["nomeMae"] ?>">
                        </div>

                        <div class="telefone">
                            <label for="telefone">Telefone <label style="color:red">*</label></label><br>
                            <input type="text" name="txtTelefone" required value="<?php echo $aluno["telefone"] ?>">
                        </div>

                        <div class="naturalidade">
                            <label for="naturalidade">Naturalidade <label style="color:red">*</label></label><br>
                            <input type="text" name="txtNaturalidade" required value="<?php echo $aluno["naturalidade"] ?>">
                        </div>


                    </fieldset>

                    <fieldset class="endereco">
                        <legend style="font-weight: bold;">Endereco</legend>


                        <div class="estado">
                            <label for="estado">Estado <label style="color:red">*</label></label><br>
                            <input type="text" name="txtEstado" required value="<?php echo $aluno["estado"] ?>">
                        </div>

                        <div class="cep">
                            <label for="cep">CEP <label style="color:red">*</label></label><br>
                            <input type="text" name="txtCep" required value="<?php echo $aluno["cep"] ?>">
                        </div>

                        <div class="numero">
                            <label for="numero">Nº <label style="color:red">*</label></label><br>
                            <input type="number" name="numResidencia" required value="<?php echo $aluno["numeroResidencia"] ?>">
                        </div>

                    </fieldset>

                    <fieldset class="infoEscolares">
                        <legend style="font-weight: bold;">Dados Escolares</legend>

                        <div class="email">
                            <label for="email">E-mail <label style="color:red">*</label></label><br>
                            <input type="email" name="emailAluno" required value="<?php echo $aluno["email"] ?>">
                        </div>

                        <div class="senha">
                            <label for="senha">Senha <label style="color:red">*</label></label><br>
                            <input type="password" name="senhaAluno" required value="<?php echo $aluno["senha"] ?>"><br>
                        </div>

                        <div class="turma">
                            <label for="turma">Turma <label style="color:red">*</label></label><br>
                            <select name="turma" required>
                                <?php
                                include_once("conexao.php");
                                $sql = "SELECT idTurma, nome FROM Turma WHERE Escola_idEscola = $escola ORDER BY nome";

                                $turma = $conn->query($sql);
                                while ($rowTurma = $turma->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $rowTurma["idTurma"]; ?>" <?php echo ($rowTurma["idTurma"] == $aluno["Turma_idTurma"]) ? "selected" : "" ?>> <?php echo $rowTurma["nome"] ?> </option>
                                <?php
                                }
                            } else {
                                ?>
                                <script>
                                        alert("ESCOLHA UM ALUNO PRIMEIRO!");
                                        window.location = "listaAluno.php";
                                    </script>
                                <?php
                            }
                                ?>
                            </select>
                        </div><br>
                        <div class="botoes">
                            <button type="submit" name="btnEditar" value="Salvar" id="cadastrar">SALVAR</button>
                            <button type="reset" name="btnCancelar" value="Cancelar" id="cancelar">CANCELAR</button>
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

</html>