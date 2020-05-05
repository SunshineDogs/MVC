<?php

namespace Services;

class db
{
    
    private $pdo;
    
    public function __construct()
    {
        $opt = require __DIR__ . '/../settings.php';
        $dbOptions = $opt['db'];
        $this->pdo = new \PDO("mysql:dbname={$dbOptions['dbname']};host={$dbOptions['host']}",$dbOptions['user'],$dbOptions['password']);
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
