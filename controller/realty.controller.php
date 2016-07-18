<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 11:40
 */
class RealtyController extends Controller
{
    public function __call($name, $arguments)
    {
        die("FUNCTION $name NOT FOUND");
    }

    public function __construct()
    {
        if (System::get_user()->id === NULL)
        {
            $_SESSION['username'] = 'Гость';
        }
    }

    public function realty_edit($id = NULL)
    {
        if ($id === NULL)
        {
            header('Location:/realty/index_and_add');
            die();
        }


//Проверка на пост запрос об изменеии записи
        if (isset($_POST['__action']))
        {
            if ($_POST['__action'] === 'edit')
            {
                $id = (int) $_POST['id'];
                $realty = new Realty($id);
                $realty->load(System::post());
                $result = $realty->update();
                if (System::create_message('update',$result))
                {
                    header('Location:/realty/index_and_add');
                    die();
                }
            }
            if ($_POST['__action'] === 'add_tag')
            {
                $id =  (int) $_POST['id'];
                $tag_id = (int)  $_POST['tag_id'];
                $realty = new Realty($id);
                $result = $realty->realty_add_tag($tag_id);
                if (System::create_message('add_tag',$result))
                {
                    header("Location:/realty/edit/{$id}");
                    die();
                }
            }
            if ($_POST['__action'] === 'delete_tag')
            {
                $id = (int)  $_POST['id'];
                $relation_id =  (int) $_POST['relation_id'];
                $realty = new Realty($id);
                $result = $realty->realty_delete_tag($relation_id);
                if (System::create_message('delete_tag',$result))
                {
                    header("Location:/realty/edit/{$id}");
                    die();
                }
            }
        }
        $realty = new Realty($id);
        $walls = Wall::all();
        $walls = ArrayHelper::index($walls, 'id');
        $tags = RealtyTags::all();

        //Получение всех связанных с квартирой тегов
        $relation_tags = RealtyTags::get_relation_tag($id);
//        var_dump($relation_tags);
        return $this->render("realty/edit", ['realty' => $realty, 'wall' => $walls , 'relation_tags' => $relation_tags , 'tags' => $tags]); /*    , 'relation_tags' => $relation_tags , 'tags' => $tags  */
    }

    public function realty_delete($id = NULL)
    {
        if ($id === NULL)
        {
            header('Location:/realty/index_and_add');
            die();
        }

//Проверка на пост запрос об удалении записи
        if (isset($_POST['__action'])) {
            if ($_POST['__action'] === 'delete')
            {
                $id = (int) $_POST['id'];
                $realty = new Realty($id);
                $result = $realty->delete();
                if (System::create_message('delete',$result))
                {
                    header('Location:/realty/index_and_add');
                    die();
                }
            }
            header('Location:/realty/index_and_add');
        }
        $realty = new Realty($id);

        return $this->render("realty/delete", ['realty' => $realty]);
    }

    public function realty_preview($id = NULL)
    {
        if ($id === NULL)
        {
            header('Location:/realty/index_and_add');
            die();
        }

//Получение информации об просматриваемой записи


        $realty = new Realty($id);
        $relation_tags = RealtyTags::get_relation_tag($id);
        return $this->render("realty/preview", ['realty' => $realty, 'relation_tags' => $relation_tags ]);
    }


    public function realty_index_and_add()
    {
        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['__action'])) {
            if ($_POST['__action'] === 'add')
            {
                $realty = new Realty();
                $realty->load(System::post());
                $result = $realty->add();
                if (System::create_message('add',$result))
                {
                    header('Location:/realty/index_and_add');
                    die();
                }
            }
        }
        //Запрашиваем все значения из таблицы Недвижимость
//        $time_start = microtime(true);
//        for ($i=1; $i<10000; $i++)
//        {
//            $hh = Realty::all();
//        }
//        var_dump($i);
        $realty = Realty::all();
//        $time_end = microtime(true);
//        $time = $time_end - $time_start;
//        var_dump($time);
        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::all();
        $walls = ArrayHelper::index($walls, 'id');
        return $this->render("realty/index", ['realty' => $realty, 'wall' => $walls ]);
    }
    
    public function realty_group_by_wall($wall_id = NULL)
    {
        if ($wall_id === NULL)
        {
            header('Location:/realty/index_and_add');
            die();
        }
        $realty = Realty::load_wall_group($wall_id);

        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::all();
        $walls = ArrayHelper::index($walls, 'id');

        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['__action']))
        {
            if ($_POST['__action'] === 'add')
            {
                if ($_POST['__action'] === 'add')
                {
                    $realty = new Realty();
                    $realty->load(System::post());
                    $result = $realty->add();
                    if (System::create_message('add',$result))
                    {
                        header('Location:/realty/index_and_add');
                        die();
                    }
            }
            }
        }
        return $this->render("realty/index", ['realty' => $realty, 'walls' => $walls]);
    }

    public function realty_group_by_tag($tag_id = NULL)
    {
        if ($tag_id === NULL)
        {
            header('Location:/realty/index_and_add');
            die();
        }
        $realty = Realty::load_tag_group($tag_id);

        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::all();

        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['__action']))
        {
            if ($_POST['__action'] === 'add')
            {
                if ($_POST['__action'] === 'add')
                {
                    $realty = new Realty();
                    $realty->load(System::post());
                    $result = $realty->add();
                    if (System::create_message('add',$result))
                    {
                        header('Location:/realty/index_and_add');
                        die();
                    }
                }
            }
        }
        return $this->render("realty/index", ['realty' => $realty, 'walls' => $walls]);
    }
}