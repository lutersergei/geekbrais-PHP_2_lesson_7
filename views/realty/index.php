<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.07.2016
 * Time: 1:13
 */
$title="Агентство недвижимости";
?>


<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>Список недвижимости и добавление</li>
        </ol>
        <h1 class="page-header">БД недвижимости</h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                Недвижимость Красноярска
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>Комнат</th>
                            <th>Этаж</th>
                            <th>Адрес</th>
                            <th>Материал стен</th>
                            <th>Площадь, м<sup>2</sup></th>
                            <th>Цена, <i class="fa fa-rub" aria-hidden="true"></i> </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($realty as $realty_one)
                        {
                            echo <<<HTML
<tr>
                                            <td>{$realty_one->rooms}</td>
                                            <td>{$realty_one->floor}</td>
                                            <td>{$realty_one->adress}</td>
                                            <td>{$realty_one->wall->material}</td>
                                            <td>{$realty_one->area}</td>
                                            <td>{$realty_one->price}</td>                                          
                                            <td>
                                            <div class="btn-group" role="group">
                                            <a href="index.php?cat=realty&view=preview&id={$realty_one->id}" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Просмотр</a>
                                            <a href="index.php?cat=realty&view=edit&id={$realty_one->id}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            <a href="index.php?cat=realty&view=delete&id={$realty_one->id}" class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
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
                Добавление нового объекта
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="rooms" class="col-sm-2 control-label">Комнат</label>
                        <div class="col-sm-1">
                            <input type="number" required class="form-control" id="rooms" name="rooms" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="floor" class="col-sm-2 control-label">Этаж</label>
                        <div class="col-sm-1">
                            <input type="number" required class="form-control" id="floor" name="floor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adress" class="col-sm-2 control-label">Адрес</label>
                        <div class="col-sm-3">
                            <textarea class="form-control" required id="adress" name="adress" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="material" class="col-sm-2 control-label">Материал стен</label>
                        <div class="col-sm-2">
                            <select name="wall_id" class="form-control">

                                <?php
                                foreach ($wall as $w) {
                                    echo <<<HTML
           <option value="{$w->id}">{$w->material}</option>
HTML;
                                }     ?>                                      </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="area" class="col-sm-2 control-label">Площадь, м<sup>2</sup></label>
                        <div class="col-sm-1">
                            <input type="text" required  class="form-control" id="area" name="area" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Цена, <i class="fa fa-rub" aria-hidden="true"></i> </label>
                        <div class="col-sm-2">
                            <input type="number" required class="form-control" id="price" name="price" >
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