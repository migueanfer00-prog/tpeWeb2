<?php
require_once './app/config.php';

class ProductoModel {
    private $db;

    public function __construct() {
        $this->db = DBInitializer::getConection();
    }

    public function getAll() {
        // Traemos el nombre de la categoría haciendo un JOIN como pide la consigna
        $query = $this->db->prepare('SELECT p.*, c.nombre as nombre_categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($id) {
        $query = $this->db->prepare('SELECT p.*, c.nombre as nombre_categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria WHERE p.id_producto = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getByCategoria($id_categoria) {
        $query = $this->db->prepare('SELECT p.*, c.nombre as nombre_categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria WHERE p.id_categoria = ?');
        $query->execute([$id_categoria]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($nombre, $descripcion, $precio, $id_categoria, $imagen_url) {
        $query = $this->db->prepare('INSERT INTO productos (nombre, descripcion, precio, id_categoria, imagen_url) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $descripcion, $precio, $id_categoria, $imagen_url]);
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
    }

    public function update($id, $nombre, $descripcion, $precio, $id_categoria, $imagen_url) {
        $query = $this->db->prepare('UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, id_categoria = ?, imagen_url = ? WHERE id_producto = ?');
        $query->execute([$nombre, $descripcion, $precio, $id_categoria, $imagen_url, $id]);
    }
}
