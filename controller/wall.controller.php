<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 11:41
 */
class WallController extends Controller
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
            $_SESSION['last_page'] = '/wall/index';
            header("Location:/auth/login");
        }
    }

    public function wall_edit($id = NULL)
    {
        if ($id === NULL)
        {
            header('Location:/wall/index');
            die();
        }

//Проверка на пост запрос об изменеии записи
        if (isset($_POST['__action'])) {
            if ($_POST['__action'] === 'edit')
            {
                $id = (int)  $_POST['id'];
                $wall = new Wall($id);
                $wall->load(System::post());
                $result = $wall->update();
                if (System::create_message('update',$result))
                {
                    header('Location:/wall/index');
                    die();
                }
            }
        }
        //Получение информации об изменяемой записи для передачи в начальные значения
        $wall = new Wall($id);

        return $this->render("wall_types/edit_types", ['wall' => $wall]);
    }

    public function wall_delete($id = NULL)
    {
        if ($id === NULL)
        {
            header('Location:/wall/index');
            die();
        }
//Проверка на пост запрос об удалении записи
        if (isset($_POST['__action']))
        {
            if (($_POST['__action'] === 'delete'))
            {
                $id = (int) $_POST['id'];
                $wall = new Wall($id);
                $result = $wall->delete();
                if (System::create_message('delete',$result))
                {
                    header('Location:/wall/index');
                    die();
                }
            }
            else
            {
                header('Location:/wall/index');
                die();
            }
        }
        $wall = new Wall($id);
        return $this->render("wall_types/delete_types", ['wall' => $wall]);
    }

    public function wall_preview($id = NULL)
    {
        if ($id === NULL)
        {
            header('Location:/wall/index');
            die();
        }
        $wall = new Wall($id);
        return $this->render("wall_types/preview_types", ['wall' => $wall]);
    }

    public function wall_index()
    {
        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::all();
        return $this->render("wall_types/wall_types", ['walls' => $walls]);
    }

    public function wall_add()
    {
        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['__action'])) {
            if ($_POST['__action'] === 'add') {
                $wall = new Wall();
                $wall->load(System::post());
                $result = $wall->add();
                if (System::create_message('add',$result))
                {
                    header('Location:/wall/index');
                    die();
                }
            }
        }
        return $this->render("wall_types/add", []);
    }
}