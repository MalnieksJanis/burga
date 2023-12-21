<?php
include 'db.php';

class User {
    private $db;

    public function __construct() {
        $this->db = DB::getInstance()->getConnection();
    }

    public function authenticateUser($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM lietotaji WHERE lietotajvards = ? AND parole = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true; // Lietotājs atrasts
        } else {
            return false; // Lietotājs nav atrasts
        }
    }

    public function isAdmin($username) {
        $stmt = $this->db->prepare("SELECT loma FROM lietotaji WHERE lietotajvards = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['loma'] == 'administrators';
        } else {
            return false;
        }
    }
}
?>
