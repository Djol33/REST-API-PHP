<?php

namespace App\Model;
use App\Model\DB;
use App\DTO\Order;
class SelectAllOrdersModel extends DB implements  IModel
{

    public function __construct()
    {
        parent::__construct();
    }
    public function Execute()
    {
         $sql = "SELECT o.id, o.value, p.id as p_id,  oi.id as orderItemId, p.name as productName, p.price
            FROM `order` o
            LEFT JOIN orderitem oi ON oi.orderId = o.id
            INNER JOIN product p ON oi.productId = p.id
         ";
        $stmt = $this->pdo->query($sql);


        $rows = $stmt->fetchAll( );

        $orders = [];

        foreach ($rows as $row) {
            $orderId = $row['id'];


            if (!isset($orders[$orderId])) {
                $orders[$orderId] = [
                    "id" => $orderId,
                    "value" => $row['value'],
                    "items" => []
                ];
            }

             if ($row['orderItemId']) {
                $orders[$orderId]['items'][] = [
                    "orderItemId" => $row['orderItemId'],
                    "name" => $row['productName'],
                    "price" => $row['price']
                ];
            }
        }
        $finalResult = array_values($orders);

        return ($finalResult);


    }


}