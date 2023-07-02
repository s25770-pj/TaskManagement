<?php
if (isset($_SESSION['logged'])){
    header("Location: ../index.php");
    die;
}

class LoginRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM user WHERE username = :username";

        $statement = $this->db->getConnection()->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (($user) && (password_verify($password, $user['password']))) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['logged'] = true;

            return true;
        } else {
            return false;
        }
    }
}