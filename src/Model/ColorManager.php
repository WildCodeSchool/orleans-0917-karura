<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:11
 */

namespace Karura\Model;

/**
 * Class ColorManager
 * @package Karura\Model
 */
class ColorManager extends Manager
{
    const TABLE = 'color';

    const CLASSREF = Color::class;

    /**
     * @return array
     */
    public function findAll()
    {
        $req = "SELECT *
                FROM " . self::TABLE ."
                ORDER BY name";
        $statement = $this->pdo->query($req);
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        $req = "SELECT *
                FROM " . self::TABLE . "
                WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, self::CLASSREF);
        return $statement->fetch();
    }

    /**
     * @param string $colorName
     * @return mixed
     */
    public function findByName(string $colorName)
    {
        $req = "SELECT * 
                FROM " . self::TABLE . "
                WHERE name=:name";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('name', $colorName, \PDO::PARAM_STR);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, self::CLASSREF);
        return $statement->fetch();
    }

    public function insert(Color $color)
    {
        $req = "INSERT INTO " . self::TABLE . "
                (name, hexa)
                VALUES (:name, :hexa)";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('name', $color->getName(), \PDO::PARAM_INT);
        $statement->bindValue('hexa', $color->getHexa(), \PDO::PARAM_INT);
        $statement->execute();
    }

    public function update(Color $color)
    {
        $id = $color->getId();
        $name = $color->getName();
        $hexa = $color->getHexa();

        $req = "UPDATE " . self::TABLE . "
                SET id=:id, name=:name, hexa=:hexa
                WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->bindValue('name', $name, \PDO::PARAM_INT);
        $statement->bindValue('hexa', $hexa, \PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * @param Category $category
     */
    public function delete(Color $color)
    {
        $id = $color->getId();
        $req = "DELETE
                FROM " . self::TABLE . "
                WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

}