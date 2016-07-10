<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 20:54
 */
function render ($view_name, $data = [], $with_layout = true)
{
    ob_start();
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once ("views/$view_name.php");
    $content = ob_get_contents();
    ob_end_clean();

    if ($with_layout)
    {
        ob_start();

        require_once ('views/layout/index.php');
        $content = ob_get_contents();
       
        ob_end_clean();
    }
    return $content;
}

function class_autoload($classname)
{
    if (mb_substr($classname, -10, NULL, 'utf-8') === 'Controller')
    {
        $class_string = mb_substr($classname, 0, mb_strlen($classname, 'utf-8')-10, 'utf-8');
        $name = preg_replace('/([a-z])([A-Z])/', '$1_$2', $class_string);
        $file_name = "controller/".mb_strtolower($name, 'utf-8').'.controller.php';

        if (file_exists($file_name))
        {
            include_once $file_name;
        }
        else
        {
            die('Файл с классом не найден');
        }
    }
}

function name2controller_class_name ($name)
{
    $pie = explode('_', $name);
    $result = '';
    foreach ($pie as $item)
    {
        $result .=ucfirst($item);
    }
    $result.= "Controller";
    return $result;
}
