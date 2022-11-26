<?php

declare(strict_types=1);

/**
 * MySql database
 */

namespace Framework\Database;

/**
 * MySqlDatabase
 */
class MySqlDatabase
{
    /**
     * @var \PDO
     * @access private
     */
    private $pdo;

    /**
     * Constructor
     * @access public
     * @param string $dbHost
     * @param string $dbName
     * @param string $dbUsername
     * @param string $dbPassword
     * 
     * @return void
     */
    public function __construct(string $dbHost, string $dbName, string $dbUsername, $dbPassword)
    {
        $pdo = new \PDO(
            'mysql:host=' . $dbHost . 
            ';dbname=' . $dbName .
            ';charset=utf8',
            $dbUsername,
            $dbPassword
        );

        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->pdo = $pdo;
    }

    /**
     * Get pdo
     * @access public
     * 
     * @return \PDO
     */
    public function getPdo(): \PDO
    {
        return $this->pdo;
    }
}