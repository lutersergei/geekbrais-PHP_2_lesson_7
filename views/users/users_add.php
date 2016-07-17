<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 11.07.2016
 * Time: 0:50
 */
$title="Добавление пользователя";
?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Добавление нового пользователя
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="room" class="col-sm-2 control-label">Имя пользователя</label>
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" required class="form-control" id="username" name="username" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Пароль</label>
                                <div class="col-sm-3 input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" required class="form-control" id="__password" name="__password" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Роль пользователя</label>
                                <div class="col-sm-3 input-group">
                                    <select  class="form-control" name="role" id="role">
                                        <?php
                                        foreach (Users::$roles as $key=>$role)
                                        {?>
                                        <option value="<?= $key ?>"> <?= $role ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="hidden" name="__action" value="add">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-plus fa-lg" aria-hidden="true"></i> Добавить</button>
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