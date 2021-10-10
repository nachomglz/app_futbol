<?php 
    function autenticated() {
        session_start();
        $auth = $_SESSION['login'];
        return $auth ? true : false;
    }
