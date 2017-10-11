<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:11
 */

namespace Karura\Model;


class ModelManager
{
    const TABLE = 'model';
    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(DSN, USER, PASS);
    }


    public function findAll()
    {
        $req = "SELECT * FROM " . self::TABLE;
        $statement = $this->pdo->query($req);
        return $statement->fetchAll(\PDO::FETCH_CLASS, \Karura\Model\Category::class);
    }
    public function find(int $id)
    {
        $req = "SELECT * FROM " . self::TABLE . " WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $model = $statement->fetchAll(\PDO::FETCH_CLASS, \Karura\Model\Category::class);
        return $model[0];
    }

    public function insert()
    {
        // TODO
    }
    public function update()
    {
        // TODO
    }
    public function delete(Model $model)
    {
        $id = $model->getId();
        $req = "DELETE FROM self::TABLE WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
    
}