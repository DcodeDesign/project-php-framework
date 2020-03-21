<?php

class HomeController extends Controller {

    function __construct($model){
        $this->model = new $model();
        $this->titrePage = 'Home';
        $this->template = 'templates/template-default.php';
        $this->private = false;
        $this->login = 'template-login';
    }

    public function initView (){
        return array('titre' => 'Titre',  'contenu' => 'Text');
    }
}
