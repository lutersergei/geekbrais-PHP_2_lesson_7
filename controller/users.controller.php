<?php
class UsersController extends Controller
{
    public function __call($name, $arguments)
    {
        die($name);
    }

    public function __construct()
    {
        if ((System::get_user()->id === NULL))
        {
            header("Location:/auth/login");
        }
    }

    public function users_index()
    {
        if ((System::get_user()->role !== Users::ROLE_ADMIN))
        {
            header("Location:/auth/login");
        }

        $users = Users::all();

        return $this->render("users/users_list", ['users' => $users]);
    }

    public function users_add()
    {
        if ((System::get_user()->role !== Users::ROLE_ADMIN))
        {
            header("Location:/auth/login");
        }

        if (isset($_POST['__action']))
        {
            if ($_POST['__action'] === 'add')
            {
                $password = $_POST['__password'];
                $users = new Users();
                $users->load(System::post());
                $users->create_password($password);
                $result = $users->add();
                if (System::create_message('add',$result))
                {
                    header('Location:/users/index');
                    die();
                }
            }
        }
        return $this->render("users/users_add", []);
    }

    public function users_edit($id = NULL)
    {
        if ($id === NULL)
        {
            header('Location:/users/index');
            die();
        }

        if (isset($_POST['__action']))
        {
            if ($_POST['__action'] === 'edit')
            {
                if ($_POST['__password'] !== '')
                {
                    if ($_POST['__password'] === $_POST['_password'])
                    {
                        $users = new Users($id);
                        $users->load(System::post());
                        $users->create_password($_POST['_password']);
                        $result = $users->update();
                        if (System::create_message('update',$result))
                        {
                            $users->auth($_POST['username'], $_POST['_password']);
                            header('Location:/users/index');
                            die();
                        }
                    }
                    else
                    {
                        System::create_message(NULL, Model::PASSWORD_INCORRECT);
                        header("Location:/users/edit/{$id}");
                        die();
                    }
                }
                else
                {
                    $users = new Users($id);
                    $users->load(System::post());
                    $result = $users->update();
                    if (System::create_message('update',$result))
                    {
                        $_SESSION['username'] = $users->username;
                        header('Location:/users/index');
                        die();
                    }
                }
            }
            else
            {
                header('Location:/users/index');
                die();
            }
        }


        $users = new Users($id);
        return $this->render("users/users_edit", ['users' => $users]);
    }
}