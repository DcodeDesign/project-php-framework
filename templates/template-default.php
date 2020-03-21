<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="style/style.css"/>
    <title><?php echo $titrePage ?></title>
</head>
<body>
<div id="global">
    <header>
    </header>
    <nav>
        <a href="http://localhost:8888/generateView/accueil" >Accueil</a> |
        <a href="http://localhost:8888/generateView/contact" >Contact</a> |
        <?php
        if ($this->private && $this->session_activate()) {
         ?>
            <a href="<?php echo Url::getRequestUrl() ?>?session_destroy=1" >Déconnection</a>
        <?php
        }
        ?>

    </nav>
    <div id="contenu">
        <?php echo $generate ?>
    </div>
    <footer>
    </footer>
</div>
</body>
</html>