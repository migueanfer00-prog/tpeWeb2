<?php
require_once 'app/model/model_panaderia.php';
require_once 'app/views/view_panaderias.php';


class controllerPanaderia{
    
    private $model;
    private $views;


    public function __construct() {
        $this->model = new model_panaderia();
        $this->views = new view_panaderias();
    }

function mostrarPanaderias(){
    $panaderias = $this->model->getAll();
    $this ->views->showPanaderias();







}}