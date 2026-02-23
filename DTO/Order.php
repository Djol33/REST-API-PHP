<?php
use OrderItem;
class Order
{

    public int $Id;
    public mixed $value;
    /** @var OrderItem[] */
    public array $orderitem;
}