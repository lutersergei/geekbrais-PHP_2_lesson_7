<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 16.07.2016
 * Time: 18:03
 */
class Controller
{
    protected $layout = 'index.php';

    public function render ($view_name, $data = [], $with_layout = true)
    {
        ob_start();
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        require_once ("views/$view_name.php");
        $content = ob_get_contents();
        ob_end_clean();

        if ($with_layout)
        {
            ob_start();

            require_once ("views/layout/{$this->layout}");
            $content = ob_get_contents();

            ob_end_clean();
        }
        return $content;
    }
}