<?php
/**
 * Created by PhpStorm.
 * User: PAD
 * Date: 06.02.2019
 * Time: 10:45
 */

namespace App;

class Checkout
{

    /**
     * @var PricingList
     */
    private $pricingList;

    /**
     * @var Invocice
     */
    private $invoice;

    /**
     * Checkout constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        try {
            $this->pricingList = new PricingList();
        } catch (\Exception $e) {
            exit("Cant create Pricingslist");
        }
        if (!empty($this)) {
            $this->invoice = new Invocice();
        }
    }


    public function scan($item) {
        if(!empty($item)) {
            $this->calculatePricesByItem($item);
        }
    }

    /**
     * @return mixed
     */
    public function total() {
        return $this->invoice->getEntry("total")->getPrice();
    }

    /**
     * @param $itemName
     */
    private function calculatePricesByItem($itemName)
    {
        $totalPrice = $this->total();
        $quantity = 1;
        $currentEntry = $this->invoice->getEntry($itemName);

        if (!empty($currentEntry)) {
            $currentEntry->setQuantity($currentEntry->getQuantity() + $quantity);
            $totalPrice -= $currentEntry->getPrice();
            $determineObj = $this->pricingList->determinePrice($currentEntry);
            $this->invoice->writeEntry($determineObj);
        } else {
            $determineObj = $this->pricingList->determinePrice(new Item(array(
                    "product_id" => $itemName,
                    "quantity" => $quantity,
                    "price" => 0)
            ));

            $this->invoice->writeEntry($determineObj);
        }

        $totalItem = $this->invoice->getEntry("total");
        $totalItem->setPrice($determineObj->getPrice() + $totalPrice);
        $this->invoice->writeEntry($totalItem);
    }

}