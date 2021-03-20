<?php
namespace App\Machine;

/**
 * Class PurchasedTransactionImplementations
 * @package App\Machine
 */
class PurchasedTransactionImplementations implements PurchaseTransactionInterface
{
    function __construct($item, $amount)
    {
        $this->item = $item;        // int
        $this->amount = $amount;    // float
    }
    public function getItemQuantity()
    {
        return $this->item;
    }
    public function getPaidAmount()
    {
        return $this->amount;
    }
}
