<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 10/10/17
 * Time: 17:02
 */

namespace Karura\Model;


class Declination
{
    /**
     * @var int
     */
    private $color_id;

    /**
     * @var int
     */
    private $model_id;

    /**
     * @var string
     */
    private $main_image;

    /**
     * @var string
     */
    private $secondary_image;

    /**
     * @return int
     */
    public function getColorId(): int
    {
        return $this->color_id;
    }

    /**
     * @param int $color_id
     * @return Declination
     */
    public function setColorId(int $color_id): Declination
    {
        $this->color_id = $color_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getModelId(): int
    {
        return $this->model_id;
    }

    /**
     * @param int $model_id
     * @return Declination
     */
    public function setModelId(int $model_id): Declination
    {
        $this->model_id = $model_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getMainImage(): string
    {
        return $this->main_image;
    }

    /**
     * @param string $main_image
     * @return Declination
     */
    public function setMainImage(string $main_image): Declination
    {
        $this->main_image = $main_image;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecondaryImage(): string
    {
        return $this->secondary_image;
    }

    /**
     * @param string $secondary_image
     * @return Declination
     */
    public function setSecondaryImage(string $secondary_image): Declination
    {
        $this->secondary_image = $secondary_image;
        return $this;
    }



}