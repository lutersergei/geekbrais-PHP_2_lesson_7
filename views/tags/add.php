<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 20.07.2016
 * Time: 14:42
 */
$title="Добавление тега";
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Добавление нового тега
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="room" class="col-sm-2 control-label">Название</label>
                        <div class="col-sm-3">
                            <input type="text" required class="form-control" id="title" name="title" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="__action" value="add">
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить</button>
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
