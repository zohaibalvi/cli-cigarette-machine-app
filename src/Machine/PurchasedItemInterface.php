<?php

namespace App\Machine;

/**
 * Interface PurchasedItemInterface
 * @package App\Machine
 */
interface PurchasedItemInterface
{
    
    public function getItemQuantity();
    
    public function getTotalAmount();

    public function getChange();
}