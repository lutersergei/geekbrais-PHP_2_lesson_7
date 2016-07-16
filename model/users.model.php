<?php
class Users extends Model
{
    const ROLE_USER = 1;
    const ROLE_ADMIN = 10;

    public static $roles = [
        self::ROLE_USER => 'Пользватель',
        self::ROLE_ADMIN => 'Администратор'
    ];
    
    protected static $behaviours = [
        '' => []
    ];

    protected static $fields = array();
    protected static $field_types = array();

    public static function tableName()
    {
        return 'users';
    }

    public static function className()
    {
        return 'Users';
    }

    protected static function salt_generator()
    {
        $length = 32;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected static function generate_password($password, $salt)
    {
        return md5(md5($password).$salt);
    }

    public function create_password($password)
    {
        $this->salt = static::salt_generator();
        $this->password = static::generate_password($password, $this->salt);
    }

    public function check_password($password)
    {
        if ($this->salt === NULL) return false;
        $check_string = static::generate_password($password, $this->salt);
        if ($check_string === $this->password)
        {
            return true;
        }
        else return false;
    }

    public function auth_flow()
    {
        if (isset($_SESSION['username']) && isset($_SESSION['password']))
        {
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $this->get_username($username);
            if ($this->password === $password)
            {
                return true;
            }
            else
            {
                $this->id = NULL;
                $this->username = NULL;
                $this->password = NULL;
                $this->salt = NULL;
                return false;
            }
        }
        else
        {
            if (isset($_COOKIE['username']) && isset($_COOKIE['password']))
            {
                $username = $_COOKIE['username'];
                $password = $_COOKIE['password'];
                $this->get_username($username);
                if ($this->password === $password)
                {
                    $_SESSION['password'] = $_COOKIE['password'];
                    $_SESSION['username'] = $_COOKIE['username'];
                    return true;
                }
                else return false;
            }
            else
            {
                return false;
            }
        }
    }

    public function get_username($username)
    {
        $username = mysqli_real_escape_string(self::get_db(), $username);
        $query = "SELECT * FROM `".static::tableName()."` WHERE `username` = '{$username}'";
//        die(var_dump($query));
        $result = mysqli_query(self::get_db(), $query);
//        die(var_dump($result));
        if ($row = mysqli_fetch_assoc($result))
        {
            $this->load($row);
        }
    }

    public function auth($username,$password,$remember = false)
    {
        $this->get_username($username);
        if ($this->check_password($password))
        {
            $_SESSION['username'] = $this->username;
            $_SESSION['password'] = $this->password;
            if ($remember)
            {
                setcookie("username",$this->username,60*60*24);
                setcookie("password",$this->password,60*60*24);
            }
            return true;
        }
        else
        {
            return false;
        }
    }
}