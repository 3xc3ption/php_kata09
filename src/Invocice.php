<?php
/**
 * Created by PhpStorm.
 * User: PAD
 * Date: 06.02.2019
 * Time: 19:41
 */

namespace App;

/**
 * Class Invocice
 * @package App
 */
class Invocice
{

    /**
     * @var array
     */
    private $itemList = [];

    /**
     * Invocice constructor.
     */
    public function __construct()
    {

        // Es wird eine Rechung mit dem wird mit Total initiert
        $this->itemList["total"] = new Item(array(
            "product_id"=>"total",
            "quantity"=>0,
            "price"=>0)
        );
    }

    /**
     * @param Item $item
     */
    public function writeEntry(Item $item)
    {
        $this->itemList[$item->getProductId()]= $item;
    }

    /**
     * @param $itemName
     * @return Item|null
     */
    public function getEntry($itemName)
    {
        if(array_key_exists($itemName, $this->itemList)) {
            return $this->itemList[$itemName];
        }
        return null;
    }

}