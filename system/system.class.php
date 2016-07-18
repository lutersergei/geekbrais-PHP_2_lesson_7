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

    public static function set_message($type, $message)
    {
        $_SESSION[$type] = $message;
    }

    public static function get_message($type)
    {
        if (isset($_SESSION[$type]))
        {
            $value =$_SESSION[$type];
            unset($_SESSION[$type]);
            return $value;
        }
        else
        {
             return NULL;
        }
    }

    //  Генерирование сообщения на основе действия и регультата
    public static function create_message($action, $result)
    {
        if ($result === true)
        {
            if ($action === 'add')
            {
                $message = 'Объект успешно добавлен';
                static::set_message('success', $message);
                return true;
            }
            if ($action === 'update')
            {
                $message = 'Редактирование успешно';
                static::set_message('success', $message);
                return true;
            }
            if ($action === 'delete')
            {
                $message = 'Объект успешно удален';
                static::set_message('success', $message);
                return true;
            }
            if ($action === 'add_tag')
            {
                $message = 'Тег добавлен';
                static::set_message('success', $message);
                return true;
            }
            if ($action === 'delete_tag')
            {
                $message = 'Тег удален';
                static::set_message('success', $message);
                return true;
            }
            else return false;
        }
        else
            {
                if ($result === Model::CREATE_FAILED)
                {
                    $message = 'Ошибка при добавлении';
                    static::set_message('error', $message);
                    return true;
                }
                if ($result === Model::DELETE_FAILED)
                {
                    $message = 'Ошибка при удалении';
                    static::set_message('error', $message);
                    return true;
                }
                if ($result === Model::OBJECT_ALREADY_EXIST)
                {
                    $message = 'Объект уже существует';
                    static::set_message('error', $message);
                    return true;
                }
                if ($result === Model::OBJECT_NOT_EXIST)
                {
                    $message = 'Объект не найден';
                    static::set_message('error', $message);
                    return true;
                }
                if ($result === Model::UPDATE_FAILED)
                {
                    $message = 'Ошибка при редактировании';
                    static::set_message('error', $message);
                    return true;
                }
                if ($result === false)
                {
                    $message = 'Ошибка';
                    static::set_message('error', $message);
                    return true;
                }
                else return false;
            }
    }
}