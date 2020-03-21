<?php

class ContactUpdate_apiController extends ApiController {
    function __construct($model, $type){
        $this->model = new $model;
        $this->template = 'templates/template-' . $type . '-json.php';
    }

    protected function init()
    {
        $content = $this->updateFavoris();
        return array('contenu' => $content);
    }

    private function updateFavoris(){

        $data = json_decode(file_get_contents("php://input"));
        //return var_dump($data->favoris);
        //$data->favoris = $data->favoris == false ? 0 : 1;
        //return json_encode(array("id" => (int)$data->id ,"favoris" => (int)$data->favoris));
        //return var_dump($data->favoris);
        if ($data != null) {
            $query = $this->model->update("contacts", array("favoris" => $data->favoris), array("%i"), array("id" => $data->id), array("%i"));
            if ($query) {
                http_response_code(200);

                return json_encode(array("message" => "Contact mis à jour " . $_SERVER['REQUEST_METHOD']  ));
            } else {
                http_response_code(503);

                return json_encode(array("message" => "Impossible de mettre à jour le contact " . $_SERVER['REQUEST_METHOD'] ));
            }
        } else {
            http_response_code(400);

            return json_encode(array("message" => "Une erreur est survenue "));
        }
    }
}