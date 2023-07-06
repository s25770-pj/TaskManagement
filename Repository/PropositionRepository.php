<?php

class propositionRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getUserData() {
        $query = "SELECT id, username FROM user";

        $statement = $this->db->getConnection()->prepare($query);
        $statement->execute();

        $count = $statement->fetchColumn();

        return $count > 0;
    }

    public function checkIfExist($itemName) {
        $query = "SELECT COUNT(*) AS count FROM propositions WHERE itemName = :itemName";

        try {
            $statement = $this->db->getConnection()->prepare($query);
            $statement->bindValue(':itemName', $itemName);
            $statement->execute();

            $count = $statement->fetchColumn();

            return $count > 0;
        } catch (PDOException $e) {
            echo "Wystąpił błąd podczas sprawdzania istnienia propozycji: ". $e->getMessage();
        }
    }

    public function checkIfOwnPropositionsExist($id) {
        $query = "SELECT COUNT(*) AS count FROM propositions WHERE id = :id";

        try {
            $statement = $this->db->getConnection()->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();

            $count = $statement->fetchColumn();

            return $count > 0;
        } catch (PDOException $e){
            echo "Wystąpił błąd podczas wyszukiwania twoich propozycji: " . $e->getMessage();
        }
    }

    public function createPropose($itemName, $price, $link, $categoryId) {
        if ($this->checkIfExist($itemName)) {
            echo "Propozycja o nazwie $itemName już istnieje.";
            return false;
        }
        $query = "INSERT INTO propositions (itemName, price, link, categoryId) VALUES (:itemName, :price, :link, :categoryId)";

        try {
            $statement = $this->db->getConnection()->prepare($query);
            $statement->bindValue(':itemName', $itemName);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':link', $link);
            $statement->bindValue(':categoryId', $categoryId);
            $statement->execute();

            return true;
        } catch (PDOException $e) {
            echo "Wystąpił błąd podczas tworzenia propozycji: " . $e->getMessage();
            return false;
        }
    }

    public function showMyPropositions($id) {
        $query = "SELECT p.itemName, p.price, p.link, c.categoryName FROM propositions p JOIN category c ON p.categoryId = c.id WHERE p.userId = :id";
        try {
            $statement = $this->db->getConnection()->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();

            $row = $statement->fetchAll(PDO::FETCH_ASSOC);

            return true;
        } catch (PDOException $e) {
            echo "Wystąpił błąd podczas wyświetlania propozycji z bazy danych: " . $e->getMessage();

            return false;
        }
    }
}