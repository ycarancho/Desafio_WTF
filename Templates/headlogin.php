<?php
require_once('config/process.php');
require_once('config/url.php');

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
    <link rel="stylesheet" href="../Bootstrap/css/bootstra">
    <!--CSS-->
    <title>Login </title>
</head>

<body id="fundo">
    <header>
        <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="login">
            <div class="card" id="telalogin">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="email">Login</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Senha">
                        </div>
                        <input type="submit" class="btn btn-outline-success" value="Entrar">
                        <a href="<?= $BASE_URL ?>makeuser.php"> Cadastre-se !</a>
                    </form>
                </div>
            </div>
        </form>
    </header>