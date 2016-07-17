<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.06.2016
 * Time: 22:30
 */
class Wall extends Model
{
    protected static $behaviours = [
        'count' => []
    ];

    protected static $fields = array();
    protected static $field_types = array();
    
    public static function tableName()
    {
        return 'wall';
    }

    public static function className()
    {
        return 'Wall';
    }

    public static function all()
    {
        $result = parent::all();
        $walls = Wall::get_wall_count();
        $walls = ArrayHelper::index($walls, 'id');
        foreach ($result as $k=>$value)
        {
            $result[$k]->relations['count'] = $walls[$result[$k]->id]['relation_count'];
//            var_dump($result[$k]->relations['count']);
//            var_dump($walls[$result[$k]->id]['relation_count']);
//            var_dump($result[$k]->realtions);
        }
        return $result;
    }

    public static function get_wall_count()
    {
        $query = "
SELECT `wall`.*, COUNT(`realty`.`id`) AS `relation_count` 
FROM `wall` 
LEFT JOIN `realty` 
ON `realty`.`wall_id` = `wall`.`id` 
GROUP BY `wall`.`id`";
        $data_result = mysqli_query(self::get_db(), $query);
        $walls = [];
        while ($row = mysqli_fetch_assoc($data_result)) {
            $walls[] = $row;
        }
        return $walls;
    }
}
