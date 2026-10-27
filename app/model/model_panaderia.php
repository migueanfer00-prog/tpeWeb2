<?php
class model_panaderia extends model
{

    public function getAll()
    {
        
        $query = $this->db->prepare('SELECT p.*, c.nombre as nombre_categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($id)
    {
        $query = $this->db->prepare('SELECT p.*, c.nombre as nombre_categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria WHERE p.id_producto = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
