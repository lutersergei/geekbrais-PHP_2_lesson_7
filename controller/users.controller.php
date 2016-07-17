<?php
class UsersController extends Controller
{
  public function __call($name, $arguments)
  {
    die($name);
  }

    public function __construct()
    {
        if (System::get_user()->id === NULL)
        {
            // запись в сессию страницы, с которой перешли на авторизацию
            $_SESSION['last_page'] = 'index.php?cat=users&view=index';
            header("Location:index.php?cat=auth&view=login");
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
          $password = $_POST['password'];
          $users = new Users();
          $users->load(System::post());
          $users->create_password($password);
          if ($users->add() === $users::CREATE_FAILED)
          {
              die($users::CREATE_FAILED); //TODO error page 404

          }
          elseif ($users->add() === $users::DUPLICATE_FIELD)
          {
              die($users::DUPLICATE_FIELD); //TODO error page 404
          }
          else
          {
              header('Location:index.php?cat=users&view=index');
              die();
          }
      }
    }
    return $this->render("users/users_add", []);
  }
}