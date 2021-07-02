<?php

require_once("config/process.php");
require_once("dao/UserDao.php");
require_once("models/User.php");
require_once("models/message.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
//Resgata o tipo de formulario

$type = filter_input(INPUT_POST, "type");

//Verificação do tipo do formulario 
if ($type === "register") {
    $name = filter_input(INPUT_POST, "name");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    //Verificando dados minimos
    if ($name && $email && $password) {
        if ($password == $confirmpassword) {
            //verificar se o e-mail já existe
            if ($userDao->findbyEmail($email) === false) {
                //criação de token e senha 
                $user = new User();

                $userToken = $user->generateToken();
                $finalpassword = $user->generatepassword($password);

                $user->name = $name;
                $user->email = $email;
                $user->password = $finalpassword;
                $user->token = $userToken;

                $auth = true;
                //criando  o usuario e autenticando.
                $userDao->create($user, $auth);
            } else {
                $message->setMessage("Usuário já cadastrado, tente outro E-mail. ", "error", "back");
            }
        } else {
            //mensagem de erro senha 
            $message->setMessage("As senhas não são iguais. ", "error", "back");
        }
    } else {
        //mensagem de erro
        $message->setMessage("Por favor, preencha todos os campos. ", "error", "back");
    }
} elseif ($type === "login") {
    # code...
}
