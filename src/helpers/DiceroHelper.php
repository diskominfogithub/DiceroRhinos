<?php

use Diskominfo\Dicero;

function authenticatedUser(){
    return Dicero::getAuthenticatedUser();
}

function currentUserRole(){
    return Dicero::getUserRole();
}

function currentUserOpd(){
    return Dicero::getUserOpd();
}