<?php

namespace App\Machine;

/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    const ITEM_PRICE = 4.99;

    public function execute(PurchaseTransactionInterface $purchaseTransaction)
    {
        $purchasedItemImplementation  = new PurchasedItemImplementation($purchaseTransaction->getItemQuantity(), $purchaseTransaction->getPaidAmount(), self::ITEM_PRICE);
        return $purchasedItemImplementation;
    }
}
