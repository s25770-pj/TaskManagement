<?php
if (isset($_SESSION['logged'])){
    header("Location: ../index.php");
    exit;
}

class RegisterRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }
    
    public function register($username, $hashPassword, $email) {
        $query = "INSERT INTO user (username, password, email) VALUES (:username, :hashPassword, :email)";

        $statement = $this->db->getConnection()->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':hashPassword', $hashPassword);
        $statement->bindParam(':email', $email);
        $statement->execute();

        return true;
    }

    public function checkIfUsernameExists($username) {
        $query = "SELECT COUNT(*) FROM user WHERE username = :username";

        $statement = $this->db->getConnection()->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();

        $count = $statement->fetchColumn();

        return $count > 0;
    }

    public function checkIfEmailExists($email) {
        $query = "SELECT COUNT(*) FROM user WHERE email = :email";

        $statement = $this->db->getConnection()->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();

        $count = $statement->fetchColumn();

        return $count > 0;
    }
}