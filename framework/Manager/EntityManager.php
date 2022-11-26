<?php

declare(strict_types=1);

/**
 * EntityManager
 */

namespace Framework\Manager;

use Framework\Database\MySqlDatabase;

/**
 * EntityManager
 * @abstract
 */
abstract class EntityManager
{
    /**
     * @var MySqlDatabase
     * @access private
     */
    protected $database;

    /**
     * Constructor
     * @access public
     * @param MySqlDatabase $database
     * 
     * @return void
     */
    public function __construct(MySqlDatabase $database)
    {
        $this->database = $database;
    }
}