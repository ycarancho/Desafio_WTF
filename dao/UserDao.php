<?php
// require_once("config/process.php");
require_once("models/User.php");
require_once("models/message.php");

class UserDAO implements UserDAOInterface
{
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }
    public function builduser($data)
    {
        $user = new User;
        $user->id = $data["id"];
        $user->email = $data["email"];
        $user->name = $data["name"];
        $user->password = $data["password"];
        $user->token = $data["token"];

        return $user;
    }
    public function create(User $user, $authUser = false)
    {
        $stmt = $this->conn->prepare("INSERT INTO users(
            name, email, password, token
        ) VALUES (
            :name, :email, :password, :token
        )");

        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", $user->password);
        $stmt->bindParam(":token", $user->token);

        $stmt->execute();

        //validação 

        if ($authUser) {
            $this->setTokenToSessions($user->token);
        }
    }
    public function update(User $user)
    {
    }
    public function authenticateUser($email, $password)
    {
    }
    public function findbyEmail($email)
    {
        if ($email != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $user = $this->builduser($data);
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function findbyId($id)
    {
    }
    public function changepassword(User $user)
    {
    }
    public function findbyToken($token)
    {
        if ($token != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
            $stmt->bindParam(":token", $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $user = $this->builduser($data);
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function verifytoken($protected = false)
    {
        if (!empty($_SESSION["token"])) {
            $token = $_SESSION["token"];
            $user = $this->findbyToken($token);
            if ($user) {
                return $user;
            } else {
                //redireciona parar tela de login 
                // $this->message->setMessage("Faça a autenticação para acessar o sistema ", "error", "index.php");
            }
        } else {
            return false;
        }
    }
    public function setTokenToSessions($token, $redirec = true)
    {
        //salvando token na session
        $_SESSION["token"] = $token;
        if ($redirec) {
            //redireciona parar o perfil do usuario
            $this->message->setMessage("Seja bem vindo !", "success", "editprofile.php");
        }
    }
}
