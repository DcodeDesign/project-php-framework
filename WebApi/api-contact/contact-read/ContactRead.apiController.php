<?php

class ContactRead_apiController extends ApiController {
    function __construct($model, $type){
        $this->model = new $model;
        $this->template = 'templates/template-' . $type . '-json.php';
    }

    protected function init()
    {
        $content = $this->getContacts();
        return array('titre' => 'Contact', 'contenu' => $content);
    }

    public function getContacts(){
        return json_encode($this->setContacts());
    }

    private function setContacts(){
        $result = $this->query($this->model->allContacts());
        if($result[0] == null ){
            http_response_code(400);
            $result = array("message" => "Une erreur est survenue");
        }
        return $result;
    }

}