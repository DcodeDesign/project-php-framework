<?php

class RegisterController extends Controller {
    private $titrePage;

    function __construct(){
        $this->titrePage = 'Login Page';
        $this->template = 'templates/login.php';
        $this->private = false;
    }

    public function initView (){
        $this->Connection();
        return array('contenu' =>  '');
    }

    public function Connection(){
        if(isset($_POST['login']) && isset($_POST['pwd'])){
            $results = $this->select('SELECT * FROM utilisateurs WHERE login = ? AND pwd = ?', array($_POST['login'], $_POST['pwd']), array('%s', '%s'));
            if($results[0] !== null){
                $_SESSION['user'] = $results[0]->login;
                header('location:' . Url::getBaseUrl() . '/' . $_GET['return']);
            }else{
                header('location:' . Url::getRequestUrl(). '&error=Mauvais login ou mot de passe ! ');
            }
        }
    }


}
