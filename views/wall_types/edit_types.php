<!--системные переменные-->
<?php
/* @var $wall_information[] */
/* @var $material*/
/* @var $description*/

$material=$wall->material;
$description=$wall->description;
$id = $wall->id;
$title="Изменение материала"." - ".$material;
?>

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <ol class="breadcrumb">
                        <li><a href="../index.php?cat=wall&view=index_and_add">Материалы стен</a></li>
                        <li class="active">Изменение материала</li>
                    </ol>
                    <h1 class="page-header">БД недвижимости</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Редактирование записи
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Материал</th>
                                        <th>Описание</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php echo <<<HTML
                                        <form method="post" action="">
                                            <tr>                                        
                                            <td><input type="text" name="material" value="{$material}"></td>                                            
                                            <td><textarea name="description" id="" cols="50" rows="2">{$description}</textarea></td>   
                                            <td><input type="hidden" name="action" value="edit">
                                            <td><input type="hidden" name="id" value="{$id}">
                                            <button class="btn btn-default" type="submit" >Изменить</button></td>
                                            </tr>   
                                         </form>
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
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->