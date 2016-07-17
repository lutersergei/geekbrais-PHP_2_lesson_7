<!--системные переменные-->
<?php
$title="Список тегов";
//var_dump($tags[0]->count['relation_count']);
//var_dump($tags[0]->tag_id);
?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>Список тегов</li>
                </ol>
                <h1 class="page-header">БД недвижимости</h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Теги
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Объектов недвижимости</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($tags as $tag)
                                {
                                    //Если недвижимость с таки материалом существует, то материал нельзя удалить и появляется ссылка на просмотр всех сущностей с таки материалом
                                    if (($tag->count)>0) {
                                        $result="<a href=\"index.php?realty=wall&view=group_by_tag&tag_id={$tag->id}\"><span class='glyphicon glyphicon-tag'></span> {$tag->title}</a>";
                                        $disabled='disabled';
                                    }
                                    else
                                    {
                                        $result=$tag->title;
                                        $disabled=false;
                                    }
                                    echo <<<HTML
<tr>
                                            
                                            <td>$result</td>  
                                            <td>{$tag->count}</td> 
                                            <td>
                                            <div class="btn-group" role="group">
                                            <a href="../index.php?cat=realty_tags&view=edit&id={$tag->id}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            <a href="../index.php?cat=realty_tags&view=delete&id={$tag->id}"  class="btn btn-default $disabled"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
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
