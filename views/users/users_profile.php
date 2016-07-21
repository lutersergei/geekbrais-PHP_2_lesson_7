<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 20.07.2016
 * Time: 17:21
 */
$title = 'Профиль пользователя';
if ($users->profile->age === 0)
{
    $age = '';
}
else $age = $users->profile->age;
?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="/users/index">Список пользователей</a></li>
            <li class="active">Профиль пользователя</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Профиль пользователя - <strong>[<?=$users->username?>]</strong></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <img src="/img/avatar.png" alt="avatar" class="img-circle img-responsive">
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
                    <dd>
                        <hr>
                        <a href="/profile/edit/<?=$users->profile_id?>"  class="btn btn-default btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>