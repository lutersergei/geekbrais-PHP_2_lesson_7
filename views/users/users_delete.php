<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 21.07.2016
 * Time: 22:28
 */
$title = 'Удаление профиля пользователя';
if ($users->profile->age === 0)
{
    $age = '';
}
else $age = $users->profile->age;
if ($users->profile->avatar == NULL)
{
    $avatar = '/img/avatar.png';
}
else $avatar = '/'.$users->profile->avatar;
?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="/users/index">Пользователи</a></li>
            <li class="active">Профиль пользователя</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Профиль пользователя - <strong>[<?=$users->username?>]</strong></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <img src="<?=$avatar?>" alt="avatar" class="img-circle img-responsive">
            </div>
            <div class="profile col-sm-9 col-md-8 col-lg-7">
                <dl class="dl-horizontal">
                    <dt>Имя</dt>
                    <dd><?=$users->profile->name?></dd>
                    <dt>Фамилия</dt>
                    <dd><?=$users->profile->surname?></dd>
                    <dt>Отчество</dt>
                    <dd><?=$users->profile->middlename?></dd>
                    <dt>Возраст</dt>
                    <dd><?=$age?></dd>
                    <dt>О себе</dt>
                    <dd><?=$users->profile->about_me?></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
<div>
    <form action="" method="post">
        <h3 class="text-center text-uppercase"><strong>Вы действительно хотите удалить данного пользователя?</strong></h3>
        <div class="well center-block" style="max-width:250px">
            <input type="hidden" name="id" value="<?=$users->id?>">
            <button type="submit" name="__action" value="decline" class="btn btn-default btn-lg btn-block"><i class="fa fa-undo fa-lg" aria-hidden="true"></i> Отмена</button>
            <button type="submit" name="__action" value="delete" class="btn btn-danger btn-lg btn-block"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Удалить</button>
        </div>
    </form>
</div>