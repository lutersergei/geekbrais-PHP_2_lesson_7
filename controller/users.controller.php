<?php
class UsersController extends Controller
{
    public function __call($name, $arguments)
    {
        die($name);
    }

    public function __construct()
    {
        if ((System::get_user()->id === NULL) || (System::get_user()->role !== Users::ROLE_ADMIN))
        {
            header("Location:/auth/login");
        }
    }

    public function users_index()
    {
        $users = Users::all();

        return $this->render("users/users_list", ['users' => $users]);
    }

    public function users_add()
    {
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
}