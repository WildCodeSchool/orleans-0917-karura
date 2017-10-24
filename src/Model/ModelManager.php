<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:11
 */

namespace Karura\Model;


class ModelManager extends Manager
{

    const TABLE = 'model';

    const CLASSREF = Model::class;

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
        $model = $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
        return $model[0];
    }

    /**
     * Function for simple form search by model name
     * @param int $id
     * @return mixed
     */
    public function findByName(string $modelName, bool $strict = false): array
    {
        $replace = $strict ? '' : '%';
        $req = "SELECT * 
                FROM " . self::TABLE . "
                WHERE name LIKE :name";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('name', $replace . $modelName . $replace, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    /**
     * @param string $modelName
     * @param Category $category
     * @return array
     */
    public function findByNameWithCategory(string $modelName, Category $category)
    {
        $req = "SELECT * 
                FROM " . self::TABLE . "
                WHERE name LIKE :name
                AND category_id=:category_id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('name', '%' . $modelName . '%', \PDO::PARAM_STR);
        $statement->bindValue('category_id', $category->getId(), \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    /**
     * @param Category $category
     * @return array
     */
    public function findByCategory(Category $category)
    {
        $req = "SELECT * 
                FROM " . self::TABLE . "
                WHERE category_id=:category_id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('category_id', $category->getId(), \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    public function insert(Model $model)
    {
        $req = "INSERT INTO " . self::TABLE . "
                (name, description, category_id)
                VALUES (:name, :description, :category)";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('name', $model->getName(), \PDO::PARAM_STR);
        $statement->bindValue('description', $model->getDescription(), \PDO::PARAM_STR);
        $statement->bindValue('category', $model->getCategoryId(), \PDO::PARAM_STR);
        $statement->execute();
    }

    public function update(Model $model)
    {
        $id = $model->getId();
        $name = $model->getName();
        $description = $model->getDescription();
        $category = $model->getCategoryId();

        $req = "UPDATE " . self::TABLE . "
                SET id=:id, name=:name, description=:description, category_id=:category
                WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->bindValue('name', $name, \PDO::PARAM_STR);
        $statement->bindValue('description', $description, \PDO::PARAM_STR);
        $statement->bindValue('category', $category, \PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * @param Model $model
     */
    public function delete(Model $model)
    {
        $id = $model->getId();
        $req = "DELETE
                FROM " . self::TABLE . "
                WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

}