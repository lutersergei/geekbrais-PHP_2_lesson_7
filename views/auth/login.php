<?php
$title="Авторизация";
?>
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-lg-pull-4 col-lg-push-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Авторизация
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="username" class="col-sm-4 control-label">Имя пользователя</label>
                                <div class="col-sm-5 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" required class="form-control" id="username" name="username" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="__password" class="col-sm-4 control-label">Пароль</label>
                                <div class="col-sm-5 input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" required class="form-control" id="__password" name="__password" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-push-4 col-sm-5 input-group">
                                <label>
                                    <input type="checkbox" name="remember_me"> Запомнить меня
                                </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-push-4 col-sm-5 input-group" >
                                    <div class="row">
                                        <div class="col-lg-8 col-lg-pull-2 col-lg-push-2">
                                            <input type="hidden" name="__action" value="login">
                                            <button type="submit" class="btn btn-default btn-block"><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Отправить</button>
                                            <a href="/" class="btn btn-default btn-block"><span class="fa fa-undo fa-lg" aria-hidden="true"></span> Назад</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->