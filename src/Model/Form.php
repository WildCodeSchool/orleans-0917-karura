<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 25/10/17
 * Time: 10:27
 */

namespace Karura\Model;


class Form
{
    /**
     * @var string
     */
    private $reception_address;

    /**
     * @return string
     */
    public function getReceptionAddress(): string
    {
        return $this->reception_address;
    }

    /**
     * @param string $reception_address
     * @return Form
     */
    public function setReceptionAddress(string $reception_address): Form
    {
        $this->reception_address = $reception_address;
        return $this;
    }
}
