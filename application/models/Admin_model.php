<?php

class Admin_model extends CI_Model
{

    private $_login = "admin";
    private $_pass = "123";

    public function __construct()
    {
        session_start();
    }

    public function login($login, $pass)
    {
        if ($this->_login == strtolower($login) && $this->_pass == $pass) {
            return $_SESSION["is_auth"] = true;
        } else {
            return false;
        }
    }

    public function is_auth() {
        return isset($_SESSION["is_auth"]);
    }

    public function logout() {
        session_destroy();
    }
}