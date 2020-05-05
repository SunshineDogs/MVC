<?php

namespace Models;
use Services\db;

class ActivitiesWithTasks
{
    public static function ShowAllTasks(): array
    {
        $db = new db();
        
        return $db->query('SELECT * FROM `zadacha`;', [], self::class);
    }
    
    public static function UpdateStatusOfTask($id_Task)
    {
        $db = new db();

        return $db->query("UPDATE zadacha SET status=1 WHERE id = '$id_Task';", [], self::class);
    }
    
    public static function UpdateTextOfTask($text,$id_Task)
    {
        $db = new db();

        return $db->query("UPDATE zadacha SET text=? WHERE id = '$id_Task';", [$text], self::class);
    }
    
    public static function UpdateRedbyAdmin($id_Task)
    {
        $db = new db();
    
        return $db->query("UPDATE zadacha SET red_by_admin=1 WHERE id = '$id_Task';", [], self::class);
    }

    public static function AddTask()
    {
        $db = new db();
        $new_FIO = $_POST['user_name'];
        $new_email = $_POST['e-mail'];
        $new_text1 = $_POST['text'];
        $new_text2 = htmlspecialchars($new_text1);
        $new_text = strip_tags($new_text2);

        return $db->query("INSERT INTO `zadacha` VALUES (NULL,?,?,?,0,0);", [$new_FIO,$new_email,$new_text], self::class);
    }
}
