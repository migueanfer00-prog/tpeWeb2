<?php
// app/config.php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'panaderia_tpe');

class DBInitializer {
    private static $pdo = null;

    public static function getConection() {
        if (self::$pdo === null) {
            try {
                // 1. Conexión sin BD para verificar si existe
                $initialPdo = new PDO("mysql:host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASS);
                $initialPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // 2. Crear BD si no existe
                $initialPdo->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8 COLLATE utf8_general_ci");
                
                // 3. Conexión formal definitiva
                self::$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // 4. Inicialización de tablas básicas (Auto-deploy)
                $result = self::$pdo->query("SHOW TABLES LIKE 'productos'");
                if ($result->rowCount() == 0) {
                    self::deployDatabase();
                }
            } catch (PDOException $e) {
                die("Error de infraestructura en base de datos: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    private static function deployDatabase() {
        $sql = "
            CREATE TABLE IF NOT EXISTS categorias (
                id_categoria INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                descripcion TEXT
            );

            CREATE TABLE IF NOT EXISTS productos (
                id_producto INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                descripcion TEXT,
                precio DECIMAL(10,2) NOT NULL,
                id_categoria INT,
                FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS usuarios (
                id_usuario INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL
            );

            INSERT INTO categorias (nombre, descripcion) VALUES 
            ('Panes', 'Variedades saladas tradicionales'),
            ('Facturas', 'Masas dulces hojaldradas');

            INSERT INTO productos (nombre, descripcion, precio, id_categoria) VALUES 
            ('Pan Felipe', 'Crocante por fuera, tierno por dentro', 1200.00, 1),
            ('Medialuna de Manteca', 'Masa dulce artesanal', 350.00, 2);

            -- Administrador obligatorio de prueba requerido por consigna
            INSERT INTO usuarios (username, password) VALUES 
            ('webadmin', '" . password_hash('admin', PASSWORD_DEFAULT) . "');
        ";
        self::$pdo->exec($sql);
    }
}
