<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 11.07.2016
 * Time: 0:16
 */
class UsersController
{
    public function __call($name, $arguments)
    {
        die($name);
    }

    public function users_index()
    {
        $users = Users::all();
        
        return render("users/users_list", ['users' => $users]);
    }

    public function add()
    {
        if (isset($_POST['action']))
        {
            if ($_POST['action'] === 'add')
            {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];
                $users = new Users();
                $users->username = $username;
                $users->role = $role;
            }
        }
        return render("users/users_add", ['users' => $users]);
    }
}