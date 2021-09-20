<?php
require_once './Classes/Users.php';

function processForm()
{

    $user = new Users();
    $formFields = ['firstName', 'lastName', 'password', 'email', 'birthDate'];

    foreach ($formFields as $field) {
        if(isset($_POST[$field])){
            $user->{'set' . ucfirst($field)}($_POST[$field]);
        }else {
            throw new Exception('Veuillez remplir tous les champs');
        }
    }
}