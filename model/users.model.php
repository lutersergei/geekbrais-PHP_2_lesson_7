<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 10.07.2016
 * Time: 23:45
 */
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
}