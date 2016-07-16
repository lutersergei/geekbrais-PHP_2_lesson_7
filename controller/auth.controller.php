<?php

class AuthController
{
    public function __call($name, $arguments)
    {
        die($name);
    }
    
    public function auth_login()
    {
        if (isset($_POST['action']))
        {
            if ($_POST['action'] === 'login')
            {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $users = new Users();
                if ($users->auth($username, $password))
                {
                    header("Location: /");
                    die();
                }
                else
                {
                    header("Location:index.php?cat=auth&view=login");
                    die();
                }
            }
        }
        return render("auth/login", []);
    }
}