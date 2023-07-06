<?php
class RegisterRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function register($username, $hashPassword, $email) {
        try {
            $query = "INSERT INTO user (username, password, email) VALUES (:username, :hashPassword, :email)";

            $statement = $this->db->getConnection()->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':hashPassword', $hashPassword);
            $statement->bindValue(':email', $email);
            $statement->execute();

            return true;
        } catch (PDOException $e) {
            echo "Wystąpił błąd podczas rejestracji: " . $e->getMessage();
            return false;
        }
    }

    public function checkIfUsernameExists($username) {
        try {
            $query = "SELECT COUNT(*) FROM user WHERE username = :username";

            $statement = $this->db->getConnection()->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->execute();

            $count = $statement->fetchColumn();

            return $count > 0;
        } catch (PDOException $e) {
            echo "Wystąpił błąd podczas sprawdzania istnienia nazwy użytkownika: " . $e->getMessage();
            return false;
        }
    }

    public function checkIfEmailExists($email) {
        try {
            $query = "SELECT COUNT(*) FROM user WHERE email = :email";

            $statement = $this->db->getConnection()->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();

            $count = $statement->fetchColumn();

            return $count > 0;
        } catch (PDOException $e) {
            echo "Wystąpił błąd podczas sprawdzania istnienia adresu e-mail: " . $e->getMessage();
            return false;
        }
    }
}
