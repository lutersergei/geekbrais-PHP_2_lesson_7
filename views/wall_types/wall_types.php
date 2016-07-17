<!--системные переменные-->
<?php
$title="Материалы стен";
//var_dump($walls);
?>

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li>Материалы стен</li>
                    </ol>
                    <h1 class="page-header">БД недвижимости</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Материалы стен
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Материал</th>
                                        <th>Объектов недвижимости</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($walls as $wall)
                                    {
                                        //Если недвижимость с таки материалом существует, то материал нельзя удалить и появляется ссылка на просмотр всех сущностей с таки материалом
                                        if (($wall->count)>0) {
                                            $result="<a href=index.php?realty=wall&view=group_by_wall&wall_id={$wall->id}>{$wall->material}</a>";
                                            $disabled='disabled';
                                        }
                                        else
                                        {
                                            $result=$wall->material;
                                            $disabled=false;
                                        }
                                        echo <<<HTML
<tr>
                                            <td>$result</td>
                                            <td>{$wall->count}</td>       
                                            <td>
                                            <div class="btn-group" role="group">
                                            <a href="../index.php?cat=wall&view=preview&id={$wall->id}" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Просмотр</a>
                                            <a href="../index.php?cat=wall&view=edit&id={$wall->id}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            <a href="../index.php?cat=wall&view=delete&id={$wall->id}"  class="btn btn-default $disabled"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
                                            </div>
                                            </td>
                                            </tr>
                                            
HTML;
                                    }?>

                                    </tbody>
                                </table>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Добавление нового материала
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label for="room" class="col-sm-2 control-label">Название материала</label>
                                    <div class="col-sm-3">
                                        <input type="text" required class="form-control" id="material" name="material" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">Описание</label>
                                    <div class="col-sm-3">
                                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="hidden" name="action" value="add">
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
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
