<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:11
 */

namespace Karura\Model;


class DeclinationManager extends Manager
{
    const TABLE = 'declination';

    const CLASSREF = Declination::class;

    // SELECT Methods

    /**
     * @return array
     */
    public function findAll()
    {
        $req = "SELECT * FROM " . self::TABLE;
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
        $declination = $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
        return $declination[0];
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function findByCategory(Category $category)
    {
        $req = "SELECT decl.*
                FROM " . self::TABLE . " as decl
                JOIN model
                ON decl.model_id = model.id
                WHERE model.category_id=:category_id";

        $statement = $this->pdo->prepare($req);
        $statement->bindValue('category_id', $category->getId(), \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    /**
     * @param Model $model
     * @return array
     */
    public function findByModel(Model $model)
    {
        $req = "SELECT *
                FROM " . self::TABLE . " as decl
                WHERE model_id=:model_id";

        $statement = $this->pdo->prepare($req);
        $statement->bindValue('model_id', $model->getId(), \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    /**
     * @param Color $color
     * @return array
     */
    public function findByColor(Color $color)
    {
        $req = "SELECT *
                FROM " . self::TABLE . " as decl
                WHERE color_id=:color_id";

        $statement = $this->pdo->prepare($req);
        $statement->bindValue('color_id', $color->getId(), \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    // INSERT Methods
    public function insert()
    {
        // TODO
    }

    // UPDATE Methods
    public function update()
    {
        // TODO
    }

    // DELETE Methods

    /**
     * @param Declination $declination
     */
    public function delete(Declination $declination)
    {
        $id = $declination->getId();
        $req = "DELETE FROM self::TABLE WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

}