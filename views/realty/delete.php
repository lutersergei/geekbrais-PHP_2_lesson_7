<!--системные переменные-->
<?php
$title="Удаление помещения";
$rooms = $realty->rooms;
$floor = $realty->floor;
$adress = $realty->adress;
$id = $realty->id;
$wall_material = $realty->wall->material;
$area = $realty->area;
$price = $realty->price;
$description = $realty->description;
?>

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php?cat=realty&view=index_and_add">Список недвижимости и добавление</a></li>
                        <li class="active">Удаление помещения</li>
                    </ol>
                    <h1 class="page-header">БД недвижимости</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Просмотр записи
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Комнат</th>
                                        <th>Этаж</th>
                                        <th>Адресс</th>
                                        <th>Материал стен</th>
                                        <th>Площадь, м<sup>2</sup></th>
                                        <th>Цена, <i class="fa fa-rub" aria-hidden="true"></i> </th>
                                        <th>Описание</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php echo <<<HTML
<tr>
                                            <td>{$rooms}</td>
                                            <td>{$floor}</td>
                                            <td>{$adress}</td>
                                            <td>{$wall_material}</td>
                                            <td>{$area}</td>
                                            <td>{$price}</td>
                                            <td>{$description}</td> 
                                            </tr>                                       
HTML;
                                    
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div>
                        <form action="" method="post">
                            <h3 class="text-center text-uppercase"><strong>Вы действительно хотите удалить данную запись?</strong></h3>
                            <div class="well center-block" style="max-width:250px">
                                <input type="hidden" name="id" value="<?=$id?>">
                                <button type="submit" name="action" value="decline" class="btn btn-default btn-lg btn-block"><i class="fa fa-undo fa-lg" aria-hidden="true"></i> Отмена</button>
                                <button type="submit" name="action" value="delete" class="btn btn-danger btn-lg btn-block"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Удалить</button>
                            </div>
                        </form>
                    </div>


                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
