<?php
/**
 * Created by PhpStorm.
 * User: PAD
 * Date: 06.02.2019
 * Time: 11:33
 */

namespace App;

use phpDocumentor\Reflection\Types\Integer;

/**
 * Class PricingList
 * @package App
 */
class PricingList
{

    private $pricingList= [];

    /**
     * PricingList constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $filePath = __DIR__ . "/resources/priceListStore.json";
        if(!file_exists($filePath)) {
           throw new \Exception("File not found: " . $filePath);
        }

        $json = file_get_contents($filePath);
        $jsonIterator = json_decode($json,TRUE);

        $itemCount = 0;
        foreach ($jsonIterator["prices"] as $key => $val) {
            if(is_array($val) && !empty($val)) {
                $this->pricingList[$val['product_id']][$itemCount++] = new Item($val);
            }
            usort($this->pricingList[$val['product_id']], array("App\Item", "sortPricing"));
        }
    }

    /**
     *
     * @method Integer getQuantity()
     * @method Integer getPrice()
     * @param Item $item
     * @return Item
     */
    public function determinePrice(Item $item) {
        $sortPricingList = $this->pricingList[$item->getProductId()];
        if(empty($sortPricingList)) {
            throw new \InvalidArgumentException("Index " . $item->getProductId() . " nicht gefunden.");
        }
        $quantity = $item->getQuantity();
        $updatePrice = 0;
        while ($quantity != 0) {
            foreach ($sortPricingList as $obj) {
                if ($obj->getQuantity() <= $quantity) {
                    $updatePrice += $obj->getPrice();
                    $quantity -= $obj->getQuantity();
                    break;
                }
            }
        }
        $item->setPrice($updatePrice);
        return $item;
    }

}