<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 20.07.2016
 * Time: 16:37
 */
class ProfileController extends Controller
{
    function __call($name, $arguments)
    {
        die('404');
    }

    public function __construct()
    {
        if (System::get_user()->id === NULL)
        {
            // запись в сессию страницы, с которой перешли на авторизацию
            $_SESSION['last_page'] = '/wall/index';
            header("Location:/auth/login");
        }
    }

    public function profile_edit($id)
    {
        if ($id === NULL)
        {
            header('Location:/users/index');
            die();
        }

        $users = new Users();
        $users->one($id, 'profile_id');

        if (isset($_POST['__action']))
        {
            if ($_POST['__action'] === 'edit')
            {
                $profile = new Profile($id);
                $profile->load(System::post());
                $result = $profile->update();
                if (System::create_message('update',$result))
                {
                    header("Location:/users/profile/$users->id");
                    die();
                }
            }
        }

        $profile = new Profile($id);

        return $this->render("users/users_edit", ['profile' => $profile, 'users' => $users]);
    }
}