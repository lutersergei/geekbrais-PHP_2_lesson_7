<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 30.06.2016
 * Time: 13:54
 */

class RealtyTagsController extends Controller
{
    function __call($name, $arguments)
    {
        die('404');
    }

    public function __construct()
    {
        global $system;
        if ($system->user->id === NULL)
        {
            // запись в сессию страницы, с которой перешли на авторизацию
            $_SESSION['last_page'] = 'index.php?cat=realty_tags&view=index_and_add';
            header("Location:index.php?cat=auth&view=login");
        }
        else
        {
            $_SESSION['current_user'] = $system->user->username;
        }
    }

    public function realty_tags_index_and_add()
    {
//Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'add')
            {
                $tag = new RealtyTags();
                $tag->title = $_POST['title'];
                if ($tag->add())
                {
                    header("Location:index.php?cat=realty_tags&view=index_and_add");
                    die();
                }
                else
                {
                    die(ERROR_CREATE);
                }
            }
        }

        //Запрашиваем все значения из таблицы Типы_Стен
        $tags = RealtyTags::all();
        return $this->render("tags/tags_list", ['tags' => $tags]);
    }

    public function realty_tags_edit()
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
        if (isset($_POST['action']))
        {
            if ($_POST['action'] === 'edit')
            {
                $id = (int)  $_POST['id'];
                $tag = new RealtyTags($id);
                $tag->title = $_POST['title'];
                if ($tag->update())
                {
                    header("Location:index.php?cat=realty_tags&view=index_and_add");
                    die();
                }
                else
                {
                    die(ERROR_UPDATE);
                }
            }
        }
//Получение информации об изменяемой записи для передачи в начальные значения
        $tag = new RealtyTags($id);
        return $this->render("tags/edit_tags", ['tag' => $tag]);
    }

    public function realty_tags_delete()
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
        if (isset($_POST['action'])) {
            if (($_POST['action'] === 'delete'))
            {
                $id = (int) $_POST['id'];
                $tag = new RealtyTags($id);
                $tag->title = $_POST['title'];
                if ($tag->delete())
                {
                    header("Location:index.php?cat=realty_tags&view=index_and_add");
                    die();
                }
                else
                {
                    die(ERROR_DELETE);
                }
            }
            else
            {
                header('Location:index.php?cat=realty_tags&view=index_and_add');
                die('404');
            }
        }
        //Получение информации об просматриваемой записи
        $tag = new RealtyTags($id);
        return $this->render("tags/delete_tags", ['tag' => $tag]);
    }
}