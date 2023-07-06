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

    public function createPropose($itemName, $price, $link, $categoryId) {
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
}