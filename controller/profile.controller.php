<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 20.07.2016
 * Time: 16:37
 */
class ProfileController extends Controller
{
    function __call($name, $arguments)
    {
        die('404');
    }

    public function __construct()
    {
        if (System::get_user()->id === NULL)
        {
            // запись в сессию страницы, с которой перешли на авторизацию
            $_SESSION['last_page'] = '/wall/index';
            header("Location:/auth/login");
        }
    }

    public function profile_edit($id)
    {
        global $alphabet;

        if ($id === NULL)
        {
            header('Location:/users/index');
            die();
        }

        $users = new Users();
        $users->one($id, 'profile_id');

        if (isset($_POST['__action']))
        {
            if ($_POST['__action'] === 'edit')
            {
                $profile = new Profile($id);

                if (isset($_FILES['avatar']))
                {
                    if ($_FILES['avatar']['error'] === 0)
                    {
                        $type_array=getimagesize($_FILES['avatar']['tmp_name']);
                        $file_name=$_FILES['avatar']['name'];
                        $file_translit_name=TranslitHelper::transliteration($file_name,$alphabet);
                        $file_path=UPLOAD_IMAGES_FOLDER.$file_translit_name;
                        $file_thumb_path=THUMBNAILS_FOLDER.$file_translit_name;
                        $file_temp_name=$_FILES['avatar']['tmp_name'];
                        $file_size=$_FILES['avatar']['size'];
                        $file_error=$_FILES['avatar']['error'];
                        if (($file_size)<MAX_SIZE)
                        {   //Проверка размера файла
                            if (($type_array[2])===(1)||($type_array[2])===(2)||($type_array[2])===(3))
                            {
                                var_dump($file_error);
                                if (($file_error)===0)
                                {
                                    move_uploaded_file($file_temp_name, $file_path);
                                    ThumbnailsHelper::makeThumbnails(THUMBNAILS_FOLDER ,$file_path, $file_translit_name); //TODO Сделать квадратные превьюшки
                                    $profile->avatar = $file_thumb_path;
                                    $profile->full_avatar = $file_path;
                                    $result = $profile->update();
                                    if (System::create_message('update',$result))
                                    {
//                                        header("Location:/users/profile/$users->id");
//                                        die();
                                    }
                                }
                                else
                                {
                                    System::set_message('error', ERROR);
                                    header("Location:/users/profile/$users->id");
                                    die();
                                }
                            }
                            else
                            {
                                System::set_message('error', DANGER_NOT_IMAGE);
                                header("Location:/users/profile/$users->id");
                                die();
                            }
                        }
                        else
                        {
                            System::set_message('error', DANGER_SIZE_EXCEEDED);
                            header("Location:/users/profile/$users->id");
                            die();
                        }
                    }
                    else
                    {
                        //TODO Сообщение: не выбрали файл для фото
                    }
                }
                $profile->load(System::post());
                $result = $profile->update();
                //TODO Раздельные сообщения для ошибки/успешности педактирования инфы/аватарки
                if (System::create_message('update',$result))
                {
                    header("Location:/users/profile/$users->id");
                    die();
                }
            }
        }

        $profile = new Profile($id);

        return $this->render("users/users_edit", ['profile' => $profile, 'users' => $users]);
    }
}