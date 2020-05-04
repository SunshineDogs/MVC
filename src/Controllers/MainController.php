<?php

namespace Controllers;


use View\View;
use Models\ActivitieswithTasks;

class MainController
{
    private $view;
    public function __construct()
    {
       $this->view = new View('src' .DIRECTORY_SEPARATOR. 'templates');
    }
    public function main()
    {
        if(($_SESSION['admin'] == true)) {
            $updtask = ActivitieswithTasks::UpdateStatusOfTask((int)$_POST['status']);
            $updtexttask = ActivitieswithTasks::UpdateTextOfTask($_POST['newtext'], $_POST['admit']);
            $updtextredadmin = ActivitieswithTasks::UpdateRedbyAdmin($_POST['admit']);
        }
        $articles = ActivitieswithTasks::ShowAllTasks();

        $this->view->renderHtml('main.php', ['articles' => $articles]);
    }

    public function addtask()
    {
        $addtask = ActivitieswithTasks::AddTask();
        ?>
        <script language="javascript">
            alert("Ваша задача успешно добавлена");
        </script> <?php
        $articles = ActivitieswithTasks::ShowAllTasks();



        $this->view->renderHtml('main.php', ['articles' => $articles]);
    }



}
