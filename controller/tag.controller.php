<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 30.06.2016
 * Time: 13:54
 */

class TagController extends Controller
{
    function __call($name, $arguments)
    {
        die('404');
    }

    public function __construct()
    {
        if (System::get_user()->id === NULL)
        {
            // запись в сессию страницы, с которой перешли на авторизацию
            $_SESSION['last_page'] = '/tag/index';
            header("Location:/auth/login");
        }
    }

    public function tag_index()
    {
        //Запрашиваем все значения из таблицы Типы_Стен
        $tags = RealtyTags::all();
        return $this->render("tags/tags_list", ['tags' => $tags]);
    }

    public function tag_add()
    {
//Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['__action'])) {
            if ($_POST['__action'] === 'add')
            {
                $tag = new RealtyTags();
                $tag->load(System::post());
                $result = $tag->add();
                if (System::create_message('add',$result))
                {
                    header("Location:/tag/index");
                    die();
                }
            }
        }

        return $this->render("tags/add", []);
    }

    public function tag_edit($id = NULL)
    {
        if ($id === NULL)
        {
            header('Location:tag/index');
            die();
        }
//Проверка на пост запрос об изменеии записи
        if (isset($_POST['__action']))
        {
            if ($_POST['__action'] === 'edit')
            {
                $id = (int)  $_POST['id'];
                $tag = new RealtyTags($id);
                $tag->load(System::post());
                $result = $tag->update();
                if (System::create_message('update',$result))
                {
                    header("Location:/tag/index");
                    die();
                }
            }
        }
//Получение информации об изменяемой записи для передачи в начальные значения
        $tag = new RealtyTags($id);
        return $this->render("tags/edit_tags", ['tag' => $tag]);
    }

    public function tag_delete($id = NULL)
    {
        if ($id === NULL)
        {
            header('Location:tag/index');
            die();
        }
//Проверка на пост запрос об удалении записи
        if (isset($_POST['__action'])) {
            if (($_POST['__action'] === 'delete'))
            {
                $id = (int) $_POST['id'];
                $tag = new RealtyTags($id);
                $result = $tag->delete();
                if (System::create_message('delete',$result))
                {
                    header("Location:/tag/index");
                    die();
                }
            }
            else
            {
                header("Location:/tag/index");
                die($_POST['__action']);
            }
        }
        //Получение информации об просматриваемой записи
        $tag = new RealtyTags($id);
        return $this->render("tags/delete_tags", ['tag' => $tag]);
    }
}