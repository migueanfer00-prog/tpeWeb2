<?php
require_once 'app/model/model_admin.php';
require_once 'app/views/view_login.php';

class controllerAdmin{
    private $model;
    private $views;

    public function __construct() {
        $this->model = new AuthModel();
        $this->views = new view_login();
    }

    public static function initSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function verifyUser() {
        self::initSession();
        if (!isset($_SESSION['USER_ID'])) {
            header("Location: " . BASE_URL . "login");
            die();
        }
    }

    public static function isLoggedIn() {
        self::initSession();
        return isset($_SESSION['USER_ID']);
    }

    public function mostrarLogin() {
       $this ->views->showLogin();
    }

    public function login() {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model->getUser($username);

            if ($user && password_verify($password, $user->password)) {
                self::initSession();
                $_SESSION['USER_ID'] = $user->id_usuario;
                $_SESSION['USER_NAME'] = $user->username;
                header("Location: " . BASE_URL . "productos");
            } else {
                $this->showLogin("Usuario o contraseña incorrectos.");
            }
        } else {
            $this->showLogin("Faltan completar campos obligatorios.");
        }
    }

    public function logout() {
        self::initSession();
        session_destroy();
        header("Location: " . BASE_URL . "productos");
    }
}
