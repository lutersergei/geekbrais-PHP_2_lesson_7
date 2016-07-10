<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 11:41
 */
class WallController
{
    function __call($name, $arguments)
    {
        die('404');
    }

    public function wall_edit()
    {
        if (isset($_GET['id']))
        {
            $id = (int) $_GET['id'];
        }
        else
        {
            header('Location:index.php?cat=wall&view=index_and_add');
            die();
        }

//Проверка на пост запрос об изменеии записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'edit')
            {
                $id = (int)  $_POST['id'];
                $wall = new Wall($id);
                $wall->material = $_POST['material'];
                $wall->description = $_POST['description'];
                if ($wall->update())
                {
                    header('Location:index.php?cat=wall&view=index_and_add');
                    die();
                }
                else
                {
                    die(ERROR_UPDATE);
                }
            }
        }
        //Получение информации об изменяемой записи для передачи в начальные значения
        $wall = new Wall($id);

        return render("wall_types/edit_types", ['wall' => $wall]);
    }

    public function wall_delete()
    {
        if (isset($_GET['id']))
        {
            $id = (int) $_GET['id'];
        }
        else
        {
            header('Location:index.php?cat=wall&view=index_and_add');
            die();
        }
//Проверка на пост запрос об удалении записи
        if (isset($_POST['action']))
        {
            if (($_POST['action'] === 'delete'))
            {
                $id = (int)  $_POST['id'];
                $wall = new Wall($id);
                if ($wall->delete())
                {
                    header('Location:index.php?cat=wall&view=index_and_add');
                    die();
                }
                else
                {
                    die(ERROR_DELETE);
                }
            }
            else
            {
                header('Location:index.php?cat=wall&view=index_and_add');
                die();
            }
        }
        $wall = new Wall($id);
        return render("wall_types/delete_types", ['wall' => $wall]);
    }

    public function wall_preview()
    {
        if (isset($_GET['id']))
        {
            $id = (int) $_GET['id'];
        }
        else
        {
            header('Location:index.php?cat=wall&view=index_and_add');
            die();
        }
        $wall = new Wall($id);
        return render("wall_types/preview_types", ['wall' => $wall]);
    }

    public function wall_index_and_add()
    {
        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::all();
        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'add') {
                $wall = new Wall();
                $wall->material = $_POST['material'];
                $wall->description = $_POST['description'];
                if ($wall->add() === $wall::CREATE_FAILED)
                {
                    die($wall::CREATE_FAILED); //TODO error page 404

                }
                else
                {
                    header('Location:index.php?cat=wall&view=index_and_add');
                    die();
                }
            }
        }
        return render("wall_types/wall_types", ['walls' => $walls]);
    }
}