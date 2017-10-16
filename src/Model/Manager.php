<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 15/10/17
 * Time: 14:08
 */

namespace Karura\Model;


abstract class Manager
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * DeclinationManager constructor.
     */
    public function __construct()
    {
        $this->pdo = new \PDO(DSN, USER, PASS);
        // activate error for pdo requests
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

}