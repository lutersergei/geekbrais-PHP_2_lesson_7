<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 04.07.2016
 * Time: 20:22
 */

class Model
{
    const FIELD_NOT_EXIST = "{FIELD_NOT_EXIST}";
    const ID_ACCESS_DENIED = "{ID_ACCESS_DENIED}";
    const OBJECT_NOT_EXIST = "{OBJECT_NOT_EXIST}";
    const UPDATE_FAILED = "{UPDATE_FAILED}";
    const OBJECT_ALREADY_EXIST = "{OBJECT_ALREADY_EXIST}";
    const CREATE_FAILED = "{CREATE_FAILED}";
    const DELETE_FAILED = "{DELETE_FAILED}";

    protected static $errors = array(
        self::FIELD_NOT_EXIST,
        self::ID_ACCESS_DENIED,
        self::OBJECT_NOT_EXIST,
        self::OBJECT_ALREADY_EXIST,
        self::UPDATE_FAILED,
        self::DELETE_FAILED,
        self::CREATE_FAILED
    );

    protected static $behaviours = array();
    protected static $fields = array();
    protected static $field_types = array();
    protected static $db = NULL;

    protected $is_loaded_from_db;
    protected $is_changed;

    protected $data = array();
    protected $relations = array();
    
    public function __construct($id = NULL)
    {
        if (static::$fields === array())
        {
            static::init_fields();
        }

        if ($id !== NULL)
        {
            $id = (int) $id;
            if ($this->one($id))
            {
                $this->is_loaded_from_db = true;
            }
            else
            {
                // сообщить об ошибке
            }
        }
        else
        {
            $this->is_loaded_from_db = false;
        }

        $this->is_changed = false;
    }

    public function __get($field)
    {
        if (isset($this->data[$field]))
        {
            return $this->data[$field];
        }
        else
        {
            if (isset($this->relations[$field]))
            {
                return $this->relations[$field];
            }
            else
            {
                if (in_array($field,array_keys(static::$behaviours)))
                {
                    $key = static::$behaviours[$field]['key'];
                    if (static::$behaviours[$field]['type'] = 'one')
                    {
                        $class_name = static::$behaviours[$field]['class'];
                        $value = new $class_name($this->$key);
                    }
                    else
                    {
                        $relation_key = static::$behaviours[$field]['relation_key'];
                        $class_name = static::$behaviours[$field]['class'];
                        $value = $class_name::all([$relation_key => $this->$key]);
                    }

                    return $this->relations[$field] = $value;

                }
            }

        }
        if (!(in_array($field,static::get_fields())))
        {
            return self::FIELD_NOT_EXIST;
        }
        else
        {
            return NULL;
        }
    }

    public function __set($field, $value)
    {
        if ((!in_array($field,static::$fields))&&(!in_array($field,$this->get_relation_fields()))&&(!in_array($field,array_keys(static::$behaviours))))
        {
            return self::FIELD_NOT_EXIST;
        }
        else
        {
            if ($field === 'id')
            {
                return self::ID_ACCESS_DENIED;
            }
            else
            {
                if (in_array($field,static::$fields))
                {
                    if (static::$field_types[$field] === 'int')
                    {
                        $value = (int) $value;
                    }
                    else
                    {
                        $value = mysqli_real_escape_string(self::get_db(), $value);
                    }

                    $this->data[$field] = $value;

                    if ($this->is_loaded_from_db)
                    {
                        $this->is_changed = true;
                    }

                    return $this->data[$field];


                }
                else
                {
                    if (in_array($field,array_keys(static::$behaviours)))
                    {
                        $this->relations[$field] = $value;
                    }
                    else
                    {
                        return self::FIELD_NOT_EXIST;
                    }
                }
            }
        }
    }

    protected static function get_db()
    {
        if (self::$db === NULL)
        {
            include("/../database_connection.php");
            self::$db = $link;
        }
        return self::$db;
    }

    protected static function get_fields()
    {
        if (static::$fields === array())
        {
            static::init_fields();
        }
        return static::$fields;
    }

    protected function get_relation_fields()
    {
        return array_keys($this->relations);
    }

    protected static function init_fields()
    {
        $query = "DESCRIBE `".static::tableName()."`;";
        $result = mysqli_query(self::get_db(),$query);
        while($row = mysqli_fetch_assoc($result))
        {
            static::$fields[] = $row['Field'];

            if (strpos($row['Type'],'('))
            {
                $pie = explode('(',$row['Type'],2);
                $row['Type'] = $pie[0];
            }

            static::$field_types[$row['Field']] = $row['Type'];

        }
    }

    protected static function fields_query()
    {
        $fields = static::get_fields();

        $result = '';
        foreach($fields as $f)
        {
            if ($result !== '') $result .= ', ';

            $result .= "`{$f}`";
        }

        return $result;
    }

    protected function values_query()
    {
        $fields = static::get_fields();

        $result = '';
        foreach($fields as $f)
        {
            if ($result !== '') $result .= ', ';

            if ((isset($this->data[$f]))&&($this->data[$f]!==NULL))
            {
                $result .= "'{$this->data[$f]}'";
            }
            else
            {
                $result .= "NULL";
            }
        }

        return $result;
    }

    protected function update_query($updated_fields = array())
    {
        $fields = array();

        if ($updated_fields === array())
        {
            $fields = static::get_fields();
        }
        else
        {
            foreach($updated_fields as $uf)
            {
                if (in_array($uf,static::get_fields()))
                {
                    $fields[] = $uf;
                }
            }
        }

        $result = '';
        foreach($fields as $f)
        {
            if ($result !== '') $result .= ', ';

            if ((isset($this->data[$f]))&&($this->data[$f]!==NULL))
            {
                $result .= "`{$f}` = '{$this->data[$f]}'";
            }
            else
            {
                $result .= "`{$f}` = NULL";
            }

        }
        return $result;
    }

    public static function tableName()
    {
        return NULL;
    }

    public static function className()
    {
        return 'Model';
    }

    public function is_changed()
    {
        return $this->is_changed;
    }

    public function is_loaded_from_db()
    {
        return $this->is_loaded_from_db;
    }

    public function load($data = array())
    {
        foreach($data as $k => $v)
        {
            if (!in_array($k, static::get_fields()))
            {
                return self::FIELD_NOT_EXIST;
            }
            else
            {
                if (static::$field_types[$k] === 'int')
                {
                    $v = (int) $v;
                }
                else
                {
                    $v = mysqli_real_escape_string(self::get_db(), $v);
                }
                $this->data[$k] = $v;
            }
        }
        return true;
    }


    public function one($id)
    {
        $id = (int) $id;
        $query = "SELECT * FROM `".static::tableName()."` WHERE `id` = '{$id}'";
        $result = mysqli_query(self::get_db(),$query);
        if ($row = mysqli_fetch_assoc($result))
        {
            return $this->load($row);
        }
        else
        {
            return false;
        }
    }

    public function update()
    {
        if ($this->id === NULL) return self::OBJECT_NOT_EXIST;
        $query = "UPDATE `".static::tableName()."` SET ".$this->update_query()." WHERE `id` = '$this->id'";
        $result = mysqli_query(self::get_db(),$query);

        if ($result)
        {
            $this->is_changed = false;
            return true;
        }
        else
        {
            return self::UPDATE_FAILED;
        }
    }

    public function add()
    {
        if ($this->id !== NULL) return self::OBJECT_ALREADY_EXIST;
        $query = "INSERT INTO `".static::tableName()."` (".static::fields_query().") VALUES (".$this->values_query().")";
        $result = mysqli_query(self::get_db(),$query);

        if ($result)
        {
            $this->data['id'] = mysqli_insert_id(self::get_db());
            $this->is_changed = false;
            return true;
        }
        else
        {
            return self::CREATE_FAILED;
        }
    }

    public function delete()
    {
        if ($this->id === NULL) return self::OBJECT_NOT_EXIST;

        $query = "DELETE FROM `".static::tableName()."` WHERE `id` = '{$this->id}' LIMIT 1";
        $result = mysqli_query(self::get_db(),$query);

        if ($result)
        {
            $this->data['id'] = NULL;
            $this->is_changed = false;
            $this->is_loaded_from_db = false;
            return true;
        }
        else
        {
            return self::CREATE_FAILED;
        }
    }

    public static function all()
    {
        $query = "SELECT * FROM `".static::tableName()."` WHERE 1";
        $result = mysqli_query(self::get_db(),$query);
        $all = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $class_name = static::className();
            $one = new $class_name();
            /* @var $one Model */
            if ($one->load($row))
            {
                $all[] = $one;
            }
        }
        return $all;
    }
}