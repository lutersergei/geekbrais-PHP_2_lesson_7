<?php

class AuthController extends Controller
{
    public function __call($name, $arguments)
    {
        die($name);
    }

    public function __construct()
    {
        $this->layout = 'auth.php';
    }

    public function auth_login()
    {
        if (isset($_POST['__action']))
        {
            if ($_POST['__action'] === 'login')
            {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $users = new Users();
                if ($users->auth($username, $password))
                {
                    if (isset($_SESSION['last_page']))
                    {
                        header("Location: {$_SESSION['last_page']}");
                        unset($_SESSION['last_page']);
                        die();
                    }
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
        return $this->render("auth/login", []);
    }
}