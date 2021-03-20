<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Machine\CigaretteMachine;
use App\Machine\PurchasedTransactionImplementations;

/**
 * Class CigaretteMachine
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    /**
     * @param InputInterface   $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // inputs
        $itemCount = (int) $input->getArgument('packs');
        $amount = (float) \str_replace(',', '.', $input->getArgument('amount'));

        // initialize PurchasedTransactionImplementations class object
        $purchasetransactionObj = new PurchasedTransactionImplementations($itemCount, $amount);

        // initialize CigaretteMachine class object
        $cigaretteMachine = new CigaretteMachine();
        $obj = $cigaretteMachine->execute($purchasetransactionObj);

        // initializing all the vaiable with their values
        $total_amount_packs = CigaretteMachine::ITEM_PRICE * $obj->getItemQuantity();
        $exceeded_amount = round(($total_amount_packs - $amount), 2);
        $item_price = CigaretteMachine::ITEM_PRICE;
        $no_of_qty = $obj->getItemQuantity();

        $output->writeln("You bought <info>{$no_of_qty}</info> packs of cigarettes for <info>{$total_amount_packs}</info>, each for <info>{$item_price}</info>.");

        //check if user amount is less or greater than to the actual packs amount
        if (!is_array($obj->getChange()) && $obj->getChange())
            $output->writeln("Unfortunatly, you have to pay <info>{$exceeded_amount}</info> more!");
        else {
            $sum = (float)$obj->getTotalAmount() - $total_amount_packs;
            $output->writeln('Your change is:' . round($sum, 2));
            $table = new Table($output);
            $table
                ->setHeaders(array('Coins', 'Count'))
                ->setRows($obj->getChange());
            $table->render();
        }
    }
}
