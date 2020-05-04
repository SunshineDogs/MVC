<?php

namespace Services;

class db
{
    private $pdo;
    public function __construct()
    {
        $dbOptions = (require __DIR__ . '/src/' . str_replace('\\', DIRECTORY_SEPARATOR, settings)['db'];
        
        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
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
