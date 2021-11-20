<?php

require_once "libs/smarty/libs/Smarty.class.php";

class UserView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showFormLogin($UserFail = null, $PasswordFail = null, $email = null, $password = null)
    {
        $this->smarty->assign('UserFail', $UserFail);
        $this->smarty->assign('PasswordFail', $PasswordFail);
        $this->smarty->assign('email', $email);
        $this->smarty->assign('password', $password);
        $this->smarty->display('templates/main/showFormLogin.tpl');
    }

    function showApp(){
        $this->smarty->display('templates/main/showApp.tpl');
    }
}
