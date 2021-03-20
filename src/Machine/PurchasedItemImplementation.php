<?php

namespace App\Machine;

/**
 * Class PurchasedItemImplementation
 * @package App\Machine
 */
class PurchasedItemImplementation implements PurchasedItemInterface
{
    function __construct($item_qty, $total_amount, $item_price)
    {
        $this->item_qty = $item_qty;                // int - input by the user
        $this->total_amount = $total_amount;        // float - Amount paid by user
        $this->item_price = $item_price;            // float - static value of each pack i.e. 4.99

    }

    public function getItemQuantity()
    {
        return $this->item_qty;
    }
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    public function getChange()
    {
        // total amount which was paid by customer >= condition original amount 
        if ($this->total_amount < ($this->item_price * $this->item_qty))
            return true;

        // initialize of curreny coins array (2 Euro - 1 Cent)
        $coins = array(2, 1, 0.50, 0.20, 0.10, 0.05, 0.02, 0.01);
        $coinCounter = array(0, 0, 0, 0, 0, 0, 0, 0);
        $result = array();

        //calculate the change coins
        $amount = $this->total_amount - ($this->item_price * $this->item_qty);

        for ($i = 0; $i < count($coins); $i++) {
            //divide coins
            if (number_format($amount, 2) >= number_format($coins[$i], 2)) {
                $coinCounter[$i] = intval(number_format($amount, 2) / number_format($coins[$i], 2));
                $amount = number_format($amount, 2) -
                    ($coinCounter[$i] *
                        number_format($coins[$i], 2));
            }

            // mapping availables coins into an array
            if ($coinCounter[$i] != 0)
                $result[] = array(number_format($coins[$i], 2), $coinCounter[$i]);
        }
        return $result;
    }
}
