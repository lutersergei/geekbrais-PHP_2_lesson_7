<?php

require_once ('initial.php');
//require_once ('database_connection.php'); //TODO DELETE
require_once ('system/system.class.php');
require_once ('system/controller.class.php');
require_once ('system/helpers/array.helper.php');
require_once ('system/helpers/thumbnails.helper.php');
require_once ('system/helpers/translit.helper.php');
require_once('system/model.class.php');
require_once('model/wall.model.php');
require_once('model/realty.model.php');
require_once ('model/tag.model.php');
require_once ('model/users.model.php');
require_once ('model/profile.model.php');
require_once ('functions.php');
spl_autoload_register('class_autoload');

if (isset($_GET['route']))
{
    $pie = explode('/', $_GET['route']);

    if (isset($pie[0]) && ($pie[0] !== ''))
    {
        $controller = $pie[0];
    }
    else
    {
        $controller='realty';
    }
    if (isset($pie[1]) && ($pie[1] !== ''))
    {
        $controller_action = $pie[1];
    }
    else
    {
        $controller_action = 'index_and_add';
    }
    if (isset($pie[2]) && ($pie[2] !== ''))
    {
        $request_id = $pie[2];
    }
    else
    {
        $request_id = NULL;
    }
}
else
{
    $controller='realty';
    $controller_action = 'index';
    $request_id = NULL;
}

$controller_class_name = name2controller_class_name($controller);
$controller_function_name = $controller."_".$controller_action;

$controller_object = new $controller_class_name();

if ($request_id !== NULL)
{
    $result = $controller_object ->  $controller_function_name($request_id);
}
else
{
    $result = $controller_object ->  $controller_function_name();
}

if ($result) echo $result;

//mysqli_close($link);