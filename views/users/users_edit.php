<?php
$title="Редактирование пользователя";
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Редактирование пользователя
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Имя пользователя</label>
                        <div class="col-sm-3 input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" required class="form-control" id="username" name="username" value="<?=$users->username?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last__password" class="col-sm-2 control-label">Новый пароль</label>
                        <div class="col-sm-3 input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" id="_password" name="_password" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="__password" class="col-sm-2 control-label">Повторите пароль</label>
                        <div class="col-sm-3 input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" id="__password" name="__password" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label">Роль пользователя</label>
                        <div class="col-sm-3 input-group">
                            <select  class="form-control" name="role" id="role">
                                <?php
                                foreach (Users::$roles as $key=>$role)
                                {
                                    $select=false;
                                    if ($users->role == $key) $select="selected";
                                    ?>
                                    <option <?= $select ?> value="<?= $key ?>"> <?= $role ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="__action" value="edit">
                            <button type="submit" class="btn btn-default"><i class="fa fa-check" aria-hidden="true"></i> Изменить</button>
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