<?php

class ContactRead_apiModel extends Model {

    function allContacts() {
        return "SELECT * FROM contacts ORDER BY id DESC";
    }

}