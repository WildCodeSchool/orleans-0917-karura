<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 25/10/17
 * Time: 10:17
 */

namespace Karura\Model;

/**
 * Class FormManager
 * @package Karura\Model
 */
class FormManager extends Manager
{
    const TABLE = 'form';

    const CLASSREF = Form::class;

    /**
     * @return array
     */
    public function findAddress()
    {
        $req = "SELECT reception_address
                FROM " . self::TABLE;
        $statement = $this->pdo->query($req);
        $statement->setFetchMode(\PDO::FETCH_CLASS, self::CLASSREF);
        return $statement->fetch();
    }

    /**
     * @param Form $receptionAddress
     */
    public function update(Form $receptionAddress)
    {
        $newReceptionAddress = $receptionAddress->getReceptionAddress();

        $req = "UPDATE " . self::TABLE . "
                SET reception_address=:newReceptionAddress";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('newReceptionAddress', $newReceptionAddress, \PDO::PARAM_STR);
        $statement->execute();
    }
}
