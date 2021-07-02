<?php
require_once('config/process.php');
require_once('models/message.php');
require_once('dao/UserDao.php');

$message = new Message($BASE_URL);
$flashmsg = $message->getMessage();

if (!empty($flashmsg["msg"])) {
    //Limpar msg
    $message->clearMessage();
}
$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifytoken(false);
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
    <title>Cadastro</title>
</head>

<body id="fundo">
    <header>
        <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="register">
            <div class="card" id="telacriacao">
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" placeholder="Nome *">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" aria-describedby="emailHelp" name="email" placeholder="E-mail *">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" name="password" placeholder="Informe sua senha *">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirmar Senha</label>
                        <input type="password" class="form-control" name="confirmpassword" placeholder="Confirme sua senha *">
                    </div>
                    <input type="submit" class="btn btn-success" value="Cadastrar">
                    <a href="<?= $BASE_URL ?>index.php">Voltar ao Login </a>
                </div>
            </div>
        </form>
    </header>
    <?php if (!empty($flashmsg["msg"])) : ?>
        <div class="msg-container">
            <p class="msg <?= $flashmsg["type"] ?>"><?= $flashmsg["msg"] ?></p>
        </div>
    <?php endif; ?>