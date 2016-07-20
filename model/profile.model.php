<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 20.07.2016
 * Time: 16:37
 */
class Profile extends Model
{
    protected static $behaviours = [

    ];

    protected static $fields = array();
    protected static $field_types = array();

    public static function tableName()
    {
        return 'profile';
    }

    public static function className()
    {
        return 'Profile';
    }

}