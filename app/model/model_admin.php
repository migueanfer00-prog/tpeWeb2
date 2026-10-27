<?php
require_once 'app/config.php';

class AuthModel {
    private $db;

    public function __construct() {
        $this->db = DBInitializer::getConection();
    }

    public function getUser($username) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE username = ?');
        $query->execute([$username]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
