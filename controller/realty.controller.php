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

    public function realty_edit()
    {
        if (isset($_GET['id']))
        {
            $id = (int) $_GET['id'];
        }
        else
        {
            header('Location:index.php?cat=realty&view=index_and_add');
            die();
        }

//Проверка на пост запрос об изменеии записи
        if (isset($_POST['action']))
        {
            if ($_POST['action'] === 'edit')
            {
                $id = (int) $_POST['id'];
                $realty = new Realty($id);
                $realty->rooms = $_POST['rooms'];
                $realty->floor = $_POST['floor'];
                $realty->adress = $_POST['adress'];
                $realty->material = $_POST['material'];
                $realty->area = $_POST['area'];
                $realty->price = $_POST['price'];
                $realty->description = $_POST['description'];
                if (!$realty->update())
                {
                    die(ERROR_UPDATE);
                }
                else
                {
                    header("Location:index.php?cat=realty&view=index_and_add");
                    die();
                }
            }
            if ($_POST['action'] === 'add_tag')
            {
                $id =  (int) $_POST['id'];
                $tag_id = (int)  $_POST['tag_id'];
                $realty = new Realty($id);
                if ($realty->realty_add_tag($tag_id))
                {
                    header("Location:index.php?cat=realty&view=edit&id={$id}");
                }
                else
                {
                    die(ERROR_CREATE);
                }
            }
            if ($_POST['action'] === 'delete_tag')
            {
                $id = (int)  $_POST['id'];
                $relation_id =  (int) $_POST['relation_id'];
                $realty = new Realty($id);
                if ($realty->realty_delete_tag($relation_id))
                {
                    header("Location:index.php?cat=realty&view=edit&id={$id}");
                }
                else
                {
                    die(ERROR_DELETE);
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

    public function realty_delete()
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        } else {
            header('Location:index.php?cat=realty&view=index_and_add');
            die();
        }

//Проверка на пост запрос об удалении записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'delete')
            {
                $id = (int) $_POST['id'];
                $realty = new Realty($id);
                if ($realty->delete()) {
                    header('Location:index.php?cat=realty&view=index_and_add');
                } else {
                    die(ERROR_DELETE);
                }
            }
            else header('Location:index.php?cat=realty&view=index_and_add');
        }
        $realty = new Realty($id);

        return $this->render("realty/delete", ['realty' => $realty]);
    }

    public function realty_preview()
    {
        if (isset($_GET['id']))
        {
            $id =  (int) $_GET['id'];
        }
        else
        {
            header('Location:index.php?cat=realty&view=index_and_add');
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
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'add')
            {
                $realty = new Realty();
                $realty-> rooms = $_POST['rooms'];
                $realty-> floor = $_POST['floor'];
                $realty-> adress = $_POST['adress'];
                $realty-> wall_id = $_POST['material'];
                $realty-> area = $_POST['area'];
                $realty-> price = $_POST['price'];
                $realty-> description = $_POST['description'];
                $result = $realty->add();
                if ($result)
                {
//                    var_dump($result);
                    header("Location:index.php?cat=realty&view=index_and_add");
                    die();
                }
                else die(ERROR_CREATE);
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
    
    public function realty_group_by_wall()
    {
        if (isset($_GET['wall_id']))
        {
            $wall_id = (int)  $_GET['wall_id'];
        }
        else
        {
            header('Location:index.php?cat=realty&view=index_and_add');
            die();
        }
        $realty = Realty::load_wall_group($wall_id);

        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::all();
        $walls = ArrayHelper::index($walls, 'id');

        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action']))
        {
            if ($_POST['action'] === 'add')
            {
                if ($_POST['action'] === 'add')
                {
                $realty = new Realty();
                $realty-> rooms = $_POST['rooms'];
                $realty-> floor = $_POST['floor'];
                $realty-> adress = $_POST['adress'];
                $realty-> wall_id = $_POST['material'];
                $realty-> area = $_POST['area'];
                $realty-> price = $_POST['price'];
                $realty-> description = $_POST['description'];
                if (!$realty->add())
                {
                    header("Location:index.php?cat=realty&view=index_and_add");
                    die();
                }
                else
                {
                    die(ERROR_CREATE);
                }
            }
            }
        }
        return $this->render("realty/index", ['realty' => $realty, 'walls' => $walls]);
    }

    public function realty_group_by_tag()
    {
        if (isset($_GET['tag_id']))
        {
            $tag_id =  (int) $_GET['tag_id'];
        }
        else
        {
            header('Location:index.php?cat=realty&view=index_and_add');
            die();
        }
        $realty = Realty::load_tag_group($tag_id);

        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::all();

        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action']))
        {
            if ($_POST['action'] === 'add')
            {
                if ($_POST['action'] === 'add')
                {
                    $realty = new Realty();
                    $realty-> rooms = $_POST['rooms'];
                    $realty-> floor = $_POST['floor'];
                    $realty-> adress = $_POST['adress'];
                    $realty-> wall_id = $_POST['material'];
                    $realty-> area = $_POST['area'];
                    $realty-> price = $_POST['price'];
                    $realty-> description = $_POST['description'];
                    if (!$realty->add())
                    {
                        header("Location:index.php?cat=realty&view=index_and_add");
                        die();
                    }
                    else
                    {
                        die(ERROR_CREATE);
                    }
                }
            }
        }
        return $this->render("realty/index", ['realty' => $realty, 'walls' => $walls]);
    }
}