<?php

namespace Controllers;
use Models\Authorization;
use View\View;
use Models\ActivitieswithTasks;

class AuthorizationController extends MainController
{
    private $view;

    public function __construct()
    {
        $this->view = new View('src\templates');
    }

    public function main()
    { $articles = ActivitieswithTasks::ShowAllTasks();
        if(($_SESSION['admin'] <> true)){
        $this->view->renderHtml('auth.php');}



        else{  $this->view->renderHtml('main.php', ['articles' => $articles]);
        }
    }
    public function logout()
    {
        unset($_SESSION['admin']);
        session_unset();
        $articles = ActivitieswithTasks::ShowAllTasks();
        $this->view->renderHtml('main.php', ['articles' => $articles]);

    }
    public function actionLogin()
    {
        $articles = ActivitieswithTasks::ShowAllTasks();
            if(!isset($_SESSION['admin'])){
                $login = $_POST['login'];
                $password = $_POST['password'];
                $admin = Authorization::AccessAdmin($login,$password);
                    if($admin!=NULL)
                     {
                        $_SESSION['admin'] = true;
                        $_SESSION['login_admin'] = $login;
                         header('Location: /');
                         $this->view->renderHtml('main.php', ['articles' => $articles]);
                     }
                    else
                        {?>
                            <script language="javascript">
                            alert("Вы ввели неправильные данные");
                            </script> <?php
                        $this->view->renderHtml('main.php', ['articles' => $articles]);
                        }
            }
            else
            {
                header('Location: /');
                $this->view->renderHtml('main.php', ['articles' => $articles]);
            }
        }
}

