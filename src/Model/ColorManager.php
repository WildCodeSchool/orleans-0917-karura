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
                FROM " . self::TABLE;
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
        $category = $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
        return $category[0];
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
        $category = $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
        return $category[0];
    }

    public function insert()
    {
        // TODO
    }

    public function update(Color $color)
    {
        $id = $color->getId();
        $fields = "";
        foreach ($color as $attr => $value) {
            $fields .= $attr . "=" . "'" . $value . "'";
        }

        $req = "UPDATE " . self::TABLE . "
                SET " . $fields . "
                WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
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