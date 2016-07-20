<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 23.06.2016
 * Time: 11:34
 */
/* @var $content */
//var_dump($_SESSION);
if (!isset($title))
{
    $title='Агентство Недвижимости';
}

if (System::get_message())
{
    $success = System::get_message('success');
    if ($success !== NULL)
    {
        $message = $success;
        $message_style = 'success';
    }
    else
    {
        $error = System::get_message('error');
        if ($error !== NULL)
        {
            $message = $error;
            $message_style = 'danger';
        }
    }
}
$disabled = '';
if (System::get_user()->id === NULL)
{
    $user = 'Войти';
    $link = "/auth/login";
    $role = 'Гость';
    $disabled = 'disabled';
}
else
{
    $id = System::get_user()->id;
    $user = System::get_user()->username;
    $link = "/auth/logout";
    $role = Users::$roles[System::get_user()->role];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$title?></title>

    <!-- Bootstrap Core CSS -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="/dist/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <a class="navbar-brand" href="<?=$link?>">[<?=$user?>]</a>
                <li class="dropdown <?=$disabled?>">

                    <a class="dropdown-toggle <?=$disabled?>" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/users/profile/<?=$id?>"><i class="fa fa-user fa-fw"></i> Профиль</a>
                        </li>
                        <li><a href="/users/setting/<?=$id?>"><i class="fa fa-gear fa-fw"></i> Настройки</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=$link?>"><i class="fa fa-sign-out fa-fw"></i> Выйти</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <pre class="text-uppercase text-center"><?=$role?></pre>
                            <a href="/realty/index"><i class="fa fa-home fa-fw"></i>&nbsp; Объекты недвижимости</a>
                            <a href="/wall/index"><i class="fa fa-th-list fa-fw"></i>&nbsp; Материалы стен</a>
                            <a href="/tag/index"><i class="fa fa-tags fa-fw"></i>&nbsp; Теги</a>
                            <a href="/users/index"><i class="fa fa-users fa-fw"></i>&nbsp; Пользователи</a>


                        </li>
                    </ul>
                </div>

                <!-- /.sidebar-collapse -->
            </div>

            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php
                if (isset($message))
                {
                    ?>
                    <div class="alert alert-<?=$message_style?>">
                        <?=$message?>
                    </div>
                    <?php
                }
                //Контент
                echo $content;
                ?>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/dist/js/sb-admin-2.js"></script>

</body>
</html>