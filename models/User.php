<?php

class User
{

    public $id;
    public $email;
    public $name;
    public $password;
    public $token;

    public function generateToken()
    {

        return bin2hex(random_bytes(50));
    }

    public function generatepassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}


interface UserDAOInterface
{

    public function builduser($data);
    public function create(User $user, $authUser = false);
    public function update(User $user);
    public function authenticateUser($email, $password);
    public function setTokenToSessions($token, $redirec = true);
    public function verifytoken($protected = false);
    public function findbyEmail($email);
    public function findbyToken($token);
    public function findbyId($id);
    public function changepassword(User $user);
}
