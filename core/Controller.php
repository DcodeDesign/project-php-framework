<?php
abstract class Controller extends Model
{
    protected $titrePage = "Title";
    protected $template = 'templates/template-default.php';
    protected $private = true;
    protected $login = '/generateView/template-login';

    abstract protected function initView();


    public function generate($path, $datas = "")
    {
        $this->session_destroy();
        if (!$this->private || $this->session_activate()) {
            $content = $this->generetaView($path, $datas);
            $View = $this->generetaView($this->template, array('titrePage' => $this->titrePage, 'generate' => $content));

        } else {
            header("Location: ./" . $this->login . '?return=' .  Url::getLastRouterUrl());
            exit();
        }
        echo $View;
    }

    public function getView($path)
    {
        return $this->generate($path, $this->initView());
    }


    public function generetaView($file, $datas = "")
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

    // https://paragonie.com/blog/2015/04/fast-track-safe-and-secure-php-sessions
    public function session_activate()
    {
        if (isset($_SESSION['user']) && $_SESSION['user'] != "") {
            $this->session_expire();
            return true;
        } else {
            return false;
        }
    }

    private function session_expire()
    {
        $inactive = 60;
        if (isset($_SESSION['timeout'])) {
            $session_life = time() - $_SESSION['timeout'];
            if ($session_life > $inactive) {
                session_unset();
                session_destroy();
            }
        }
        $_SESSION['timeout'] = time();
    }

    private function session_destroy(){
        if(isset($_GET['session_destroy']) && $_GET['session_destroy'] == "1" ){
            session_unset();
            session_destroy();
        }
    }

}