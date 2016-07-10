<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.06.2016
 * Time: 22:31
 */
class Realty extends Model
{
    protected static $fields = array();
    protected static $field_types = array();

    protected static $behaviours = [
        'wall' => 
            [
                'key' => 'wall_id',
                'class' => 'Wall',
                'type' => 'one'
            ]
    ];

    public static function tableName()
    {
        return 'realty';
    }

    public static function className()
    {
        return 'Realty';
    }

    public function delete()
    {
        /*  Удаление тегов, перед удалением помещения   */
        if ($this->id === NULL) return self::OBJECT_NOT_EXIST;
        $query = "DELETE FROM `realty_tags` WHERE `realty_tags`.`realty_id` = '$this->id'";
        mysqli_query(self::get_db(),$query);
        return parent::delete();
    }

    public static function all()
    {
        $result = parent::all();
        $walls = Wall::all();
        $walls = ArrayHelper::index($walls, 'id');
        foreach ($result as $k=>$value)
        {
            $result[$k]->relations['wall'] = $walls[$result[$k]->wall_id];
        }
//        var_dump($result);
        return $result;
    }

    public static function load_wall_group($wall_id)
    {
        $query = "
SELECT `realty`.*, `wall`.`material` AS `relation_wall_material`, `wall`.`id` AS `relation_wall_id` 
FROM `".static::tableName()."` LEFT JOIN `wall` ON `realty`.`wall_id`=`wall`.`id`  
WHERE `wall_id` = '$wall_id' 
ORDER BY `realty`.`id` ASC";
        $result = mysqli_query(self::get_db(),$query);
        $realty=[];
        while($row = mysqli_fetch_assoc($result))
        {
            $realty_one = new Realty();
            $realty_one->load($row);
            $realty[] = $realty_one;
        }
        return $realty;
    }

    public static function load_tag_group($tag_id)
    {
        $query = "
SELECT `realty`.*,  `realty_tags`.`tag_id`, `tags`.`title` , `wall`.`material` AS `relation_wall_material` FROM `".static::tableName()."` 
JOIN `realty_tags` ON `realty`.`id` = `realty_tags`.`realty_id`  
JOIN `tags` ON `realty_tags`.`tag_id` = `tags`.`id`  
JOIN `wall` ON `realty`.`wall_id`=`wall`.`id` 
WHERE `realty_tags`.`tag_id` = '$tag_id'";
        $result = mysqli_query(self::get_db(),$query);
        $realty=[];
        while($row = mysqli_fetch_assoc($result))
        {
            $realty_one = new Realty();
            $realty_one->load($row);
            $realty[] = $realty_one;
        }
        return $realty;
    }

    public function realty_add_tag($tag_id)
    {
        $query = "INSERT INTO `realty_tags` (`id`, `realty_id`, `tag_id`) VALUES (NULL, '$this->id', '$tag_id')";
        $result = mysqli_query(self::get_db(),$query);
        if ($result) return true;
        else return false;
    }

    public function realty_delete_tag($tag_id)
    {
        $query = "DELETE FROM `realty_tags` WHERE `id` = '$tag_id' LIMIT 1";
        $result = mysqli_query(self::get_db(),$query);
        if ($result) return true;
        else return false;
    }
}