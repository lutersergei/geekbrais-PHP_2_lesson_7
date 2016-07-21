<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 20.07.2016
 * Time: 23:21
 */
$title = 'Редактирование профиля пользователя';
if ($profile->age === 0)
{
    $age = '';
}
else $age = $profile->age;
if ($profile->avatar == NULL)
{
    $avatar = '/img/avatar.png';
}
else $avatar = '/'.$profile->avatar;
?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="/users/index">Пользователи</a></li>
            <li><a href="/users/profile/<?=$users->id?>">Профиль пользователя</a></li>
            <li class="active">Редактирование профиля пользователя</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Профиль пользователя</strong></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <img src="<?=$avatar?>" alt="avatar" class="img-circle img-responsive">
            </div>
            <div class="profile col-sm-9 col-md-8 col-lg-7">
                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Имя</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" value="<?=$profile->name?>" id="name" name="name" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="surname" class="col-sm-3 control-label">Фамилия</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" value="<?=$profile->surname?>" id="surname" name="surname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middlename" class="col-sm-3 control-label">Отчество</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" value="<?=$profile->middlename?>" id="middlename" name="middlename">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-3 control-label">Возраст</label>
                        <div class="col-sm-4">
                            <input type="number" required class="form-control" value="<?=$age?>" id="age" name="age">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="about_me" class="col-sm-3 control-label">О себе</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="about_me" name="about_me" rows="4"><?=$profile->about_me?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="avatar" class="col-sm-3 control-label">Фотография пользователя</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <input type="hidden" name="__action" value="edit">
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Изменить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>