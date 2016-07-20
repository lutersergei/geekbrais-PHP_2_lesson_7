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
                                            <a href="/realty/preview/{$realty_one->id}" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Просмотр</a>
                                            <a href="/realty/edit/{$realty_one->id}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Изменение</a>
                                            <a href="/realty/delete/{$realty_one->id}" class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
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
        <a href="/realty/add" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить</a>
        <hr>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
