<?php
/**
 * Created by PhpStorm.
 * User: PAD
 * Date: 06.02.2019
 * Time: 10:47
 */

namespace App;

use phpDocumentor\Reflection\Types\Integer;

/**
 * Class Item
 * @package App
 */
class Item {

    private $product_id;

    private $quantity;

    private $price;

    /**
     * Item constructor.
     * @param array $itemPrice
     */
    public function __construct($itemPrice = [])
    {
        if(is_array($itemPrice)) {
            foreach ($itemPrice as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getProductId() {
        return $this->product_id;
    }

    /**
     * @return mixed
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param $quantity
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    /**
     * @param $price
     */
    public function setPrice($price) {
        $this->price = $price;
    }

    /**
     * @method Integer getPrice
     * @param $o1
     * @param $o2
     * @return int
     */
    static public function sortPricing($o1, $o2) {
        if ($o1->getPrice() === $o2->getPrice()) {
            return 0;
        }
        return ($o1->getPrice() === $o2->getPrice()) ? -1 : +1;
    }

}