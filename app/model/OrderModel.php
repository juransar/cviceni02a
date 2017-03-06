<?php

namespace App\Model;

use Tracy\Debugger;


class OrderModel extends BaseModel
{
    /**
     * Metoda vrací seznam všech uživatelů
     */
    public function listOrders()
    {
        $result=$this->database->table("order");
        return $result->fetchAll();
    }

    /**
     * Metoda vrací uživatele se zadaným id, pokud neexistuje vrací NoDataFound.
     * @param int  $id
     */
    public function getOrder($id)
    {
        $selection=$this->database->table('order')->where(['id'=>$id])->fetch();
        if(!$selection)
            throw new NoDataFound('Order doesn\'t exist');
        return $selection;    }

    /**
     * Metoda vrací vloží nový nákup
     * @param array  $values
     * @return $id vloženého nákupu
     */
    public function insertOrder($values)
    {
        if(strlen($values['name'])> 64)
            throw new InvalidArgument('name too long');
        $selection=$this->database->table('order');
        return $selection->insert($values);

    }

    /**
     * Metoda edituje nákup, pokud neexistuje vrací NoDataFound.
     * @param int  $id
     * @param array  $values
     */
    public function updateOrder($id, $values)
    {

        $selection=$this->database->table('order')->where(['id'=>$id])->update($values);
        if(!$selection)
            throw new NoDataFound('order doesn\'t exist');
    }

    /**
     * Metoda odebere nákup, pokud neexistuje vrací NoDataFound.
     * @param array  $values
     */
    public function deleteOrder($id)
    {
        $selection=$this->database->table('order')->where(['id'=>$id])->delete();
        if(!$selection)
            throw new NoDataFound('Order doesn\'t exist');
    }
}