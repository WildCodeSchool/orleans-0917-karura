<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:02
 */

namespace Karura\Model;

/**
 * Class Color
 * @package Karura\Model
 */
class Color
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /** $statement->bindValue('name', $name, \PDO::PARAM_INT);
        $statement->bindValue('hexa', $hexa, \PDO::PARAM_INT);
     * @var
     */
    private $hexa;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHexa()
    {
        return $this->hexa;
    }

    /**
     * @param mixed $hexa
     */
    public function setHexa($hexa)
    {
        $this->hexa = $hexa;
        return $this;
    }

}