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
class ColorManager
{
    const TABLE = 'color';

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * CategoryManager constructor.
     */
    public function __construct()
    {
        $this->pdo = new \PDO(DSN, USER, PASS);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $req = "SELECT *
                FROM " . self::TABLE;
        $statement = $this->pdo->query($req);
        return $statement->fetchAll(\PDO::FETCH_CLASS, \Karura\Model\Color::class);
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
        $category = $statement->fetchAll(\PDO::FETCH_CLASS, \Karura\Model\Color::class);
        return $category[0];
    }

    /**
     * @param string $categoryName
     * @return mixed
     */
    public function findByName(string $colorName)
    {
        $req = "SELECT * 
                FROM " . self::TABLE . "
                WHERE name=:name";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('name', $colorName, \PDO::PARAM_INT);
        $statement->execute();
        $category = $statement->fetchAll(\PDO::FETCH_CLASS, \Karura\Model\Color::class);
        return $category[0];
    }

    public function insert()
    {
        // TODO
    }
    public function update()
    {
        // TODO
    }

    /**
     * @param Category $category
     */
    public function delete(Color $color)
    {
        $id = $category->getId();
        $req = "DELETE FROM self::TABLE WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
    
}