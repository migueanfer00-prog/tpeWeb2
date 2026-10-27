<?php
require_once 'app/config.php';

class CategoriaModel {
    private $db;

    public function __construct() {
        $this->db = DBInitializer::getConection();
    }

    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($id) {
        $query = $this->db->prepare('SELECT * FROM categorias WHERE id_categoria = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insert($nombre, $descripcion) {
        $query = $this->db->prepare('INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)');
        $query->execute([$nombre, $descripcion]);
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM categorias WHERE id_categoria = ?');
        $query->execute([$id]);
    }

    public function update($id, $nombre, $descripcion) {
        $query = $this->db->prepare('UPDATE categorias SET nombre = ?, descripcion = ? WHERE id_categoria = ?');
        $query->execute([$nombre, $descripcion, $id]);
    }
}
