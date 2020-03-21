<?php

class LoginController extends Controller {

    function __construct($model){
        $this->model = new $model();
        $this->titrePage = 'Login Page';
        $this->template = 'templates/template-login.php';
        $this->private = false;
    }

    public function initView (){
        return array('contenu' =>  $this->getConnection());
    }

    public function setConnection(){
        if(isset($_POST['login']) && isset($_POST['pwd'])){
            $results = $this->select($this->model->accessUser(), array($_POST['login'], $_POST['pwd']), array('%s', '%s'));
            if($results[0] !== null){
                $_SESSION['user'] = $results[0]->login;
                header('location:' . Url::getBaseUrl() . '/' . $_GET['return']);
            }else{
                header('location:' . Url::getRequestUrl(). '&error=Mauvais login ou mot de passe ! ');
            }
        }
    }

    public function getConnection(){
        //return json_decode($this->setConnection(), true));
        return $this->setConnection();
    }
}
