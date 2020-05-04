<?php

namespace Services;

class db
{
    private $pdo;
    public function __construct()
    {
        // $dsn = 'mysql:dbname=gb_testmvc;host=mysql101.1gb.ru';
        // $user = 'gb_testmvc';
        // $password = '6adz8d65uiw';

        // try {
        //     $dbh = new \PDO($dsn, $user, $password);
        // } catch (PDOException $e) {
        //     echo 'Подключение не удалось: ' . $e->getMessage();
        // }

        // die;

        $opt = require __DIR__ . '/../settings.php';
        $dbOptions = $opt['db'];
        
        $this->pdo = new \PDO(
            "mysql:dbname={$dbOptions['dbname']};host={$dbOptions['host']}",
            $dbOptions['user'],
            $dbOptions['password']
        );

        $this->pdo->exec('SET NAMES UTF8');
    }
    public function query(string $sql, $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll();
    }

}
