<?php

abstract class ApiController extends Model
{
    //protected $titrePage = "Title";
    //protected $template = 'templates/template-json.php';
    //protected $private = true;
    //protected $login = '/generateView/template-login';

    abstract protected function init();


    public function generate($path, $datas = "")
    {
        $content = $this->generetaInit($path, $datas);
        $View = $this->generetaInit($this->template, array('generate' => $content));
        echo $View;
    }

    public function getInit($path)
    {
        return $this->generate($path, $this->init());
    }

    public function generetaInit($file, $datas = "")
    {
        if (file_exists($file)) {
            if($datas != ""){
                extract($datas);
            }
            ob_start();
            require $file;
            return ob_get_clean();
        } else {
            echo 'Erreur';
        }
    }
}
