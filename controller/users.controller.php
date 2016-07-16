<?php
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

  public function users_add()
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
          $users->create_password($password);
          if ($users->add() === $users::CREATE_FAILED)
          {
              die($users::CREATE_FAILED); //TODO error page 404

          }
          else
          {
              header('Location:index.php?cat=users&view=index');
              die();
          }
      }
    }
    return render("users/users_add", []);
  }
}