<?php

class ContactModel{

    function allContacts() {
        return "SELECT * FROM contacts ORDER BY id DESC";
    }
}
