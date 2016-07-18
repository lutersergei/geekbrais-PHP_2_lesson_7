<!--системные переменные-->
<?php
$title="Пользователи";
?>

<!-- Page Content -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>Пользователи</li>
                </ol>
                <h1 class="page-header">БД недвижимости</h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Пользователи
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>Пользователь</th>
                                    <th>Роль</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($users as $user)
                                {
                                ?>
                                    <tr>
                                        <td><?= $user->username ?></td>
                                        <td><?= Users::$roles[$user->role] ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                            <a href="../index.php?cat=users&view=preview&id=<?= $user->id ?>" class="btn btn-default disabled"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Просмотр</a>
                                            <a href="../index.php?cat=users&view=edit&id=<?= $user->id ?>" class="btn btn-default disabled"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            <a href="../index.php?cat=users&view=delete&id=<?= $user->id ?>"  class="btn btn-default disabled"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <a href="/users/add"  class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить</a>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->