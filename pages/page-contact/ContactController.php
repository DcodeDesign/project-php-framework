<?php

class ContactController extends Controller {

    function __construct($model){
        $this->model = new $model();
        $this->titrePage = 'Home';
        $this->template = 'templates/template-default.php';
        $this->private = true;
        $this->login = 'login';
    }

    public function initView (){
        return array('titre' => 'Contact', 'contenu' => json_decode($this->getContacts(), true));
    }

    public function getContacts(){
        return json_encode($this->setContacts());
    }

    private function setContacts(){
        $result = $this->query($this->model->allContacts());
        return $result;
    }
}

