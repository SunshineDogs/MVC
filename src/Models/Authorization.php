<?php

namespace Models;
use Services\db;

class Authorization
{
    public static function AccessAdmin($login,$password)
    {
        $db = new db();

        return $db->query("SELECT * FROM `admin` WHERE Login='$login' and Password='$password';", [], self::class);
    }

}
