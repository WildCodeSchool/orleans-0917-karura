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
        $req = "SELECT *
                FROM " . self::TABLE;
        $statement = $this->pdo->query($req);
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find($id):Declination
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
    public function findByCategory(Category $category, bool $mainOnly=false)
    {
        $req = "SELECT decl.*, model.name
                FROM " . self::TABLE . " as decl
                JOIN model
                ON decl.model_id = model.id
                WHERE model.category_id=:category_id";

        if ($mainOnly) {
            $req .= " AND decl.main_color='1'";
        }

        $statement = $this->pdo->prepare($req);
        $statement->bindValue('category_id', $category->getId(), \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    /**
     * @param Model $model
     * @param bool $mainOnly
     * @return array
     */
    public function findByModel(Model $model, bool $mainOnly=false )
    {
        $req = "SELECT *
                FROM " . self::TABLE . "
                WHERE model_id=:model_id";

        if ($mainOnly) {
            $req .= " AND main_color='1'";
        }

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
                FROM " . self::TABLE . "
                WHERE color_id=:color_id";

        $statement = $this->pdo->prepare($req);
        $statement->bindValue('color_id', $color->getId(), \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, self::CLASSREF);
    }

    public function findByColorAndModel($colorId, $modelId)
    {
        $req = "SELECT *
                FROM " . self::TABLE . " as decl
                WHERE color_id=:color_id AND model_id=:model_id";

        $statement = $this->pdo->prepare($req);
        $statement->bindValue('color_id', $colorId, \PDO::PARAM_INT);
        $statement->bindValue('model_id', $modelId, \PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, self::CLASSREF);
        return $statement->fetch();
    }

    // INSERT Methods
    public function insert(Declination $declination)
    {
        $req = "INSERT INTO " . self::TABLE . "
                (main_image, secondary_image, color_id, model_id, main_color)
                VALUES (:mainImage, :secondaryImage, :colorId, :modelId, :main_color)";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('mainImage', $declination->getMainImage(), \PDO::PARAM_STR);
        $statement->bindValue('secondaryImage', $declination->getSecondaryImage(), \PDO::PARAM_STR);
        $statement->bindValue('colorId', $declination->getColorId(), \PDO::PARAM_STR);
        $statement->bindValue('modelId', $declination->getModelId(), \PDO::PARAM_STR);
        $statement->bindValue('main_color', $declination->getMainColor(), \PDO::PARAM_STR);
        $statement->execute();
    }

    // UPDATE Methods
    public function update(Declination $declination)
    {
        $id = $declination->getId();
        $modelId = $declination->getModelId();
        $colorId = $declination->getColorId();
        $mainImage = $declination->getMainImage();
        $secondaryImage = $declination->getSecondaryImage();
        $main_color = $declination->getMainColor();

        $req = "UPDATE " . self::TABLE . "
                SET main_image=:mainImage, secondary_image=:secondaryImage, color_id=:colorId, main_color=:main_color
                WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->bindValue('colorId', $colorId, \PDO::PARAM_INT);
        $statement->bindValue('mainImage', $mainImage, \PDO::PARAM_STR);
        $statement->bindValue('secondaryImage', $secondaryImage, \PDO::PARAM_STR);
        $statement->bindValue('main_color', $main_color, \PDO::PARAM_STR);
        $statement->execute();
    }

    // DELETE Methods

    /**
     * @param Declination $declination
     */
    public function delete(Declination $declination)
    {
        $modelId = $declination->getModelId();
        $colorId = $declination->getColorId();
        $req = "DELETE FROM " .  self::TABLE . " WHERE color_id=:colorId AND model_id=:modelId";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('colorId', $colorId, \PDO::PARAM_INT);
        $statement->bindValue('modelId', $modelId, \PDO::PARAM_INT);
        $statement->execute();
    }

}