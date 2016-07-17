<?php

$disabled=false;
$material=$wall->material;
$description=$wall->description;
$id = $wall->id;
$title="Просмотр материала - $material";
?>
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="../index.php?cat=wall&view=index_and_add">Материалы стен</a></li>
                        <li class="active">Просмотр материала</li>
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
                                        <th>Материал</th>
                                        <th>Описание</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php echo <<<HTML
<tr>
                                            <td>{$material}</td>                                           
                                            <td>{$description}</td>
                                            <td>
                                            <div class="btn-group" role="group">
                                            <a href="../index.php?cat=wall&view=edit&id={$id}"  class="btn btn-default "><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            </div>
                                            </td>
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
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->