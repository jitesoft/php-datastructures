<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  StaticArrayMethodsTest.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays\Tests;

use Jitesoft\Utilities\Arrays\StaticArrayMethods;
use PHPUnit\Framework\TestCase;

class StaticArrayMethodsTest extends TestCase {

    public function testForEach() {
        $arr = ["One", "Two", "Three"];

        $count = 0;
        StaticArrayMethods::forEach($arr, function($object, $index, $array) use(&$count) {
            $this->assertNotNull($object);
            $this->assertTrue(isset($array[$index]));
            $this->assertSame($object, $array[$index]);
            $count++;
        });

        $this->assertEquals(3, $count);
    }

    public function testForEachWithBreak() {
        $arr = ["One", "Two", "Three"];

        $count = 0;
        StaticArrayMethods::forEach($arr, function($o, $index) use(&$count) {
            if ($index === 2) {
                return false;
            }
            $count++;
        });

        $this->assertEquals(2, $count);
    }

    public function testMap() {

        $count = 0;
        $out   = StaticArrayMethods::map([0,1,2,3,4,5], function($object, $index, $array) use(&$count) {
            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);

            $count++;

            return $object + 1;
        });

        $this->assertEquals(6, $count);
        $this->assertEquals(1, $out[0]);
        $this->assertEquals(2, $out[1]);
        $this->assertEquals(3, $out[2]);
        $this->assertEquals(4, $out[3]);
        $this->assertEquals(5, $out[4]);
        $this->assertEquals(6, $out[5]);
    }

    public function testFilter() {
        $count = 0;
        $out   = StaticArrayMethods::filter([0,1,2,3,4,5], function($object, $index, $array) use(&$count) {
            $count++;

            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);
            return $object <= 3;
        });

        $this->assertEquals(6, $count);
        $this->assertEquals([0,1,2,3], $out);
    }

    public function testFirst() {
        $first = StaticArrayMethods::first([1,2,3,4,5]);
        $this->assertEquals(1, $first);
        $count = 0;

        $first = StaticArrayMethods::first([1,2,3,4,5], function($object, $index, $array) use(&$count) {
            $count++;

            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);
            return $object === 5;
        });

        $this->assertEquals(5, $first);
        $this->assertEquals(5, $count);
    }


}
