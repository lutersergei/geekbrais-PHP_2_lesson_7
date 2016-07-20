<!--системные переменные-->
<?php
$title="Материалы стен";
//var_dump($walls);
?>

<!-- Page Content -->
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
                                            $result="<a href=/realty/group_by_wall/{$wall->id}>{$wall->material}</a>";
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
                                            <a href="/wall/preview/{$wall->id}" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Просмотр</a>
                                            <a href="/wall/edit/{$wall->id}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            <a href="/wall/delete/{$wall->id}"  class="btn btn-default $disabled"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
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
                    <hr>
                    <a href="/wall/add" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить</a>
                    <hr>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->