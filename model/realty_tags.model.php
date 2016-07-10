<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 30.06.2016
 * Time: 13:30
 */
class RealtyTags extends Model
{
    protected static $behaviours = [
        'count' => []
    ];
    protected static $fields = array();
    protected static $field_types = array();
    
    public static function tableName()
    {
        return 'tags';
    }

    public static function className()
    {
        return 'RealtyTags';
    }

    public static function all()
    {
        $result = parent::all();
        $count_tags = RealtyTags::get_count_tags();
//        var_dump($count_tags);
        $count_tags = ArrayHelper::index($count_tags, 'id');
//        var_dump($count_tags);
        foreach ($result as $k=>$value)
        {
            $result[$k]->count = $count_tags[$result[$k]->id]['relation_count'];
//            var_dump($count_tags[$result[$k]->tag_id]['relation_count']);
        }
        return $result;
    }

    public static function get_relation_tag($id)
    {
        $query = "SELECT `realty_tags`.`id` AS `relation_id`, `tags`.* FROM `realty_tags` JOIN `tags` ON `tags`.`id`= `realty_tags`.`tag_id` WHERE `realty_tags`.`realty_id` = '$id'";
        $result = mysqli_query(self::get_db(),$query);  
        $tags = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $tags[] = $row;
        }
        return $tags;
    }

    public static function get_count_tags()
    {
        $query = "SELECT `tags`.`id`, COUNT(`realty_tags`.`id`) AS `relation_count` FROM `tags` LEFT JOIN `realty_tags` ON `realty_tags`.`tag_id` = `tags`.`id` GROUP BY `tags`.`id`";
        $result = mysqli_query(self::get_db(),$query);
        $tags = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            $tags[] = $row;
        }
        return $tags;
    }
}