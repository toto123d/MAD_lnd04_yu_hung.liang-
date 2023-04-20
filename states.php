<?php
class States {
    private $conn;

    public $id;
    public $name;
    public $nickname;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM states";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne() {
        $query = "SELECT * FROM states WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO states (name, nickname) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->nickname);
        if ($stmt->execute()) {
            return array("message" => "State created.");
        } else {
            return array("message" => "Unable to create state.");
        }
    }

    public function update() {
        $query = "UPDATE states SET name = ?, nickname = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->nickname);
        $stmt->bindParam(3, $this->id);
        if ($stmt->execute()) {
            return array("message" => "State updated.");
        } else {
            return array("message" => "Unable to update state.");
        }
    }

    public function delete() {
        $query = "DELETE FROM states WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        if ($stmt->execute()) {
            return array("message" => "State deleted.");
        } else {
            return array("message" => "Unable to delete state.");
        }
    }
}