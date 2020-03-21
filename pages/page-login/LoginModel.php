<?php

class LoginModel {

    public function accessUser(){
        return 'SELECT * FROM utilisateurs WHERE login = ? AND pwd = ?';
    }

}
