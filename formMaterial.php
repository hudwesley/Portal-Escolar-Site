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
    <title>Portal Escolar - Cadastro</title>
    <link rel="stylesheet" href="css/material.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    .form{
    margin-top: 10px;
    margin-right: 10px;
    margin-bottom: 10px;
    width: calc(100% - 200px);
    height: 100%;
    padding: 5px 0 0 20px;
}

.title, .conteudo, .data, .autor{
    margin-bottom: 10px;
}
.data, .autor, .botoes{
    display: inline;
    margin-left: 10px;
}
.title label, .conteudo label, .data label, .autor label{
    font-size: 22px;
    color: black;
    font-weight: bold;
    font-style: oblique;
}

.title input, .autor option,.autor select{
    border-top: none;
    border-left: none;
    border-right: none;
    outline: 0;
    width: 400px;
    font-size: 18px;
    font-weight: bold;
    user-select: none;
}

.conteudo textarea{
    border: 1px solid black;
    outline: 0;
    font-size: 18px;
    font-weight: bold;
    text-align: justify;
}

.data input{
    border-top: none;
    border-left: none;
    border-right: none;
    font-size: 18px;
    font-weight: bold;
    outline: 0;
}
</style>
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
                    <li><a href="listaMaterial.php">LISTA DE MATERIAIS COMPLEMENTARES</a></li>
                    <li><a href="homeLogin.php">HOME</a></li>
                </ul>
            </nav>
        </header>

        <div class="form">
        
            <form action="createMaterial.php" method="post" class="cadMaterial" style="padding-top: 15px;">
                <div class="title">
                    <label for="tituloMaterialComplementar">Assunto <label style="color:red">*</label></label><br>
                    <input type="text" required name="txtTitulo">
                </div>

                <div class="conteudo">
                    <label for="conteudo">Conteudo <label style="color:red">*</label></label><br>
                    <textarea name="txtConteudo" required cols="110" rows="15"  maxlength="1200" minlength="20"></textarea>
                </div>

                <div class="data">
                    <label for="dataAtual">Data <label style="color:red">*</label></label>
                    <?php date_default_timezone_set('America/Sao_Paulo'); ?>
                    <input type="date" required name="dataSistema" value='<?php echo date("Y-m-d"); ?>'>
                </div>

                <div class="autor">
                    <label for="administrador">Autor <label style="color:red">*</label></label>
                    <select required name="administrador">
                        <option value="<?php echo $_SESSION["idAdministrador"] ?>"><?php echo $_SESSION["nomeAdm"] ?></option>
                    </select>
                </div>
        
                <div class="botoes">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Cadastrar</button>
                    <button type="reset" class="btn btn-secondary btn-lg btn-block">Cancelar</button>
                </div>
                <br>
            </form>
        </div>
    <?php } else {
    ?>
        <script>
            alert("FAÇA LOGIN PRIMEIRO");
            window.location = "telaLogin.php";
        </script>
    <?php } ?>
</body>

</html>