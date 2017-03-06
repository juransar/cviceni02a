<?php

namespace App\Model;

use Tracy\Debugger;
use Nette\Database\Table;
use Nette\Database\Context;
use App\Model\BaseManager;
use Nette\Database\Table\IRow;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Nette\Utils\ArrayHash;
class UserModel extends BaseModel
{


    /**
     * Metoda vrací seznam všech uživatelů
     */
    public function listUsers()
    {
        $result=$this->database->table("user");
        return $result->fetchAll();
    }

    /**
     * Metoda vrací uživatele se zadaným id, pokud neexistuje vrací NoDataFound.
     * @param int  $id
     */
    public function getUser($id)
    {
        $selection=$this->database->table('user')->where(['id'=>$id])->fetch();
        if(!$selection)
            throw new NoDataFound('User doesn\'t exist');
        return $selection;

    }

    /**
     * Metoda vrací vloží nového uživatele
     * @param array  $values
     * @return $id vloženého uživatele
     */
    public function insertUser($values)
    {
        if(strlen($values['surname'])> 64||strlen($values['firstname'])>64 )
            throw new InvalidArgument('name too long');
        $selection=$this->database->table('user');
        return $selection->insert($values);

    }

    /**
     * Metoda edituje uživatele, pokud neexistuje vrací NoDataFound.
     * @param array  $values
     */
    public function updateUser($id, $values)
    {
        if(strlen($values['surname'])> 64||strlen($values['firstname'])>64 )
            throw new InvalidArgument('Surname too long');
        $selection=$this->database->table('user')->where(['id'=>$id])->update($values);
        if(!$selection)
            throw new NoDataFound('User doesn\'t exist');
    }

    /**
     * Metoda odebere uživatele, pokud neexistuje vrací NoDataFound.
     * @param array  $values
     */
    public function deleteUser($id)
    {
        $selection=$this->database->table('user')->where(['id'=>$id])->delete();
        if(!$selection)
            throw new NoDataFound('User doesn\'t exist');
    }
}