<?php

namespace App\Model;

use Tracy\Debugger;


class StatisticModel extends BaseModel
{

    /**
     * Metoda vrací seznam všech statistik, záznam bude mít položky name, min, max, avg a sum.
     */
    public function listStatistic()
    {
        $result=$this->database->table("user");
        $users=$result->fetchAll();
        $statistics=[];

        foreach ($users as $user) {
            $user_orders=$this->database->table('order')->where('user_id',$user->id)->fetchAll();
            if(count($user_orders)) $min=$max=reset($user_orders)->price*reset($user_orders)->quantity;
            else $min=$max=0;
            $sum=0;
            foreach ($user_orders as $key => $order){
                $totalPrice=$order->price*$order->quantity;
                if($totalPrice<$min) $min=$totalPrice;
                if($totalPrice>$max) $max=$totalPrice;
                $sum+=$totalPrice;
            }
            if(count($user_orders)) $avg=$sum/count($user_orders);
            else $avg=0;
            $statistics[] = array(
                "min" => $min,
                "max" => $max,
                "name" => $user->surname,
                "sum" => $sum,
                "avg" => $avg
            );
        }
        return $statistics;
    }
  }