<!--системные переменные-->
<?php
$tag_title=$tag->title;
$id = $tag->id;
$title="Удаление тега - $tag_title";
?>

<!-- Page Content -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="index.php?cat=realty_tags&view=index_and_add">Список тегов</a></li>
                    <li class="active">Удаление тега</li>
                </ol>
                <h1 class="page-header">БД недвижимости</h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Просмотр тега
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php echo <<<HTML
<tr>
                                            <td>{$tag_title}</td> </tr>                                       
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
                    <form method="post">
                        <h3 class="text-center text-uppercase"><strong>Вы действительно хотите удалить тег?</strong></h3>
                        <div class="well center-block" style="max-width:250px">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button type="submit" name="__action" value="decline" class="btn btn-default btn-lg btn-block"><i class="fa fa-undo fa-lg" aria-hidden="true"></i> Отмена</button>
                            <button type="submit" name="__action" value="delete" class="btn btn-danger btn-lg btn-block"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Удалить</button>
                        </div>
                    </form>
                </div>


            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->