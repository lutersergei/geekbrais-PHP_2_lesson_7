<?php
session_start();
error_reporting(E_ALL);
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');
define('ERROR_CREATE', 'Невозможно создать объект');
define('ERROR_UPDATE', 'Невозможно редактировать объект');
define('ERROR_DELETE', 'Невозможно удалить объект');
define('ERROR_VIEW', 'Объект не найден');
