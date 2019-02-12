<?php
/**
 * Created by PhpStorm.
 * User: PAD
 * Date: 06.02.2019
 * Time: 19:14
 */

use App\Checkout;

class PriceTest extends PHPUnit\Framework\TestCase
{

    private $checkout;

    public function price($goods) {
        $goods = str_split($goods);
        $this->checkout = new Checkout();
        foreach($goods as $key => $value) {
            $this->checkout->scan($value);
        }
        return $this->checkout->total();
    }


    public function testTotals() {
        $this->assertEquals(0, $this->price(""));
        $this->assertEquals(50, $this->price("A"));
        $this->assertEquals(80, $this->price("AB"));
        $this->assertEquals(115, $this->price("CDBA"));



        $this->assertEquals(100, $this->price("AA"));
        $this->assertEquals(130, $this->price("AAA"));
        $this->assertEquals(180, $this->price("AAAA"));
        $this->assertEquals(230, $this->price("AAAAA"));
        $this->assertEquals(260, $this->price("AAAAAA"));


        $this->assertEquals(160, $this->price("AAAB"));
        $this->assertEquals(175, $this->price("AAABB"));
        $this->assertEquals(190, $this->price("AAABBD"));
        $this->assertEquals(190, $this->price("DABABA"));
    }

    public function testIncremental() {
        $co = new Checkout();
        $this->assertEquals(0, $co->total());
        $co->scan("A");
        $this->assertEquals(50, $co->total());
        $co->scan("B");
        $this->assertEquals(80, $co->total());
        $co->scan("A");
        $this->assertEquals(130, $co->total());
        $co->scan("A");
        $this->assertEquals(160, $co->total());
        $co->scan("B");
        $this->assertEquals(175, $co->total());
    }

}
