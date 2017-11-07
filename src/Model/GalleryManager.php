<?php
/**
 * Created by PhpStorm.
 * User: coralie
 * Date: 06/11/17
 * Time: 12:05
 */

namespace Karura\Model;


class GalleryManager extends Manager
{
    const TABLE = 'gallery';

    const CLASSREF = Gallery::class;

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


    public function insert(Gallery $gallery)
    {
        $req = "INSERT INTO " . self::TABLE . "
                (name)
                VALUES (:name)";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('name', $gallery->getName(), \PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete(Gallery $gallery)
    {
        $id = $gallery->getId();
        $req = "DELETE
                FROM " . self::TABLE . "
                WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }



}