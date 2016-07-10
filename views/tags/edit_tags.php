<!--системные переменные-->
<?php
$tag_title=$tag->title;
$id = $tag->id;
$title="Изменение тега - $tag_title";
?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="index.php?cat=realty_tags&view=index_and_add">Список тегов</a></li>
                    <li class="active">Изменение тега</li>
                </ol>
                <h1 class="page-header">Lesson_6</h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Редактирование тега
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php echo <<<HTML
                                        <form method="post" action="">
                                            <td><textarea name="title" id="title" cols="30" rows="2">{$tag_title}</textarea></td>   
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