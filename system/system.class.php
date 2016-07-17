<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 11.07.2016
 * Time: 19:06
 */
class System
{
    protected static $user;

    public static function get_user()
    {
        if (self::$user === NULL)
        {
            self::$user = new Users();
            self::$user->auth_flow();
            self::$user->role = (int) self::$user->role;
//                var_dump(self::$user->auth_flow());
        }

        return self::$user;
    }

    public static function post($field = NULL, $default = NULL )
    {
        if ($field !== NULL)
        {
            if (isset($_POST[$field]))
            {
                if ($_POST[$field] !== '')
                {
                    return $_POST[$field];
                }
                else
                {
                    return $default;
                }
            }
            else
            {
                return $default;
            }
        }
        else
        {
            $result = $_POST;
            unset($result['__action']);
            unset($result['__password']);
            unset($result['id']);
            return $result;
        }
    }
}