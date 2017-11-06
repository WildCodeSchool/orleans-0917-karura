<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:02
 */

namespace Karura\Model;


class Model
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $category_id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $home_model;

    /**
     * @return string
     */
    public function getHomeModel(): string
    {
        return $this->home_model;
    }

    /**
     * @param string $home_model
     * @return Model
     */
    public function setHomeModel(string $home_model): Model
    {
        $this->home_model = $home_model;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function setId(int $id): Model
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Model
     */
    public function setName(string $name): Model
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     * @return Model
     */
    public function setCategoryId(int $category_id): Model
    {
        $this->category_id = $category_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Model
     */
    public function setDescription(string $description): Model
    {
        $this->description = $description;
        return $this;
    }


}