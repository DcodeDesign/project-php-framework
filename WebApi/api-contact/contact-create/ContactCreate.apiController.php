<?php

class ContactCreate_apiController extends Model {

    function __construct($model, $type){
        $this->model = new $model();
        $this->template = 'templates/template-' . $type . '-json.php';
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

