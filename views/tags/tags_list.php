<!--системные переменные-->
<?php
$title="Список тегов";
//var_dump($tags[0]->count['relation_count']);
//var_dump($tags[0]->tag_id);
?>

<!-- Page Content -->
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
                                        $result="<a href=/realty/group_by_tag/{$tag->id}><span class='glyphicon glyphicon-tag'></span> {$tag->title}</a>";
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
                                            <a href="/realty_tags/edit/{$tag->id}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            <a href="/realty_tags/delete/{$tag->id}"  class="btn btn-default $disabled"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
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
                <a href="/realty_tags/add" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить</a>
                <hr>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->