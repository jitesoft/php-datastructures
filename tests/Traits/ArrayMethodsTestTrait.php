<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayMethodsTestTrait.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Traits;

use ArrayAccess;
use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Arrays;
use Jitesoft\Utilities\DataStructures\Traits\ArrayMethodsTrait;

trait ArrayMethodsTestTrait {

    /**
     * @var ArrayMethodsTrait|ArrayAccess
     */
    protected $implementation;

    private function fill(...$arg) {
        $this->implementation->addRange($arg);
    }

    public function testForEach() {
        $this->fill("One", "Two", "Three");

        $count = 0;
        $this->implementation->forEach(function($object, $index, $array) use(&$count) {
            $this->assertNotNull($object);
            $this->assertTrue(isset($array[$index]));
            $this->assertSame($object, $array[$index]);
            $count++;
        });

        $this->assertEquals(3, $count);

        $count = 0;
        Arrays::forEach($this->implementation, function($object, $index, $array) use(&$count) {
            $this->assertNotNull($object);
            $this->assertTrue(isset($array[$index]), "Index is: ${index}");
            $this->assertSame($object, $array[$index]);
            $count++;
        });

        $this->assertEquals(3, $count);
    }

    public function testForEachWithBreak() {
        $this->fill("One", "Two", "Three");

        $count = 0;
        $this->implementation->forEach(function($o, $index) use(&$count) {
            if ($index === 2) {
                return false;
            }
            $count++;
        });

        $this->assertEquals(2, $count);

        $count = 0;
        Arrays::forEach($this->implementation, function($o, $index) use(&$count) {
            if ($index === 2) {
                return false;
            }
            $count++;
        });

        $this->assertEquals(2, $count);
    }

    public function testMap() {
        $this->fill(0,1,2,3,4,5);

        $count = 0;
        $out   = $this->implementation->map(function($object, $index, $array) use(&$count) {
            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);

            $count++;

            return $object + 1;
        });

        $this->assertEquals(6, $count);

        $count = 0;
        $out2  = Arrays::map($this->implementation, function($object, $index, $array) use(&$count) {
            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);

            $count++;

            return $object + 1;
        });

        $this->assertEquals(6, $count);

        $this->assertEquals(1, $out2[0]);
        $this->assertEquals(2, $out2[1]);
        $this->assertEquals(3, $out2[2]);
        $this->assertEquals(4, $out2[3]);
        $this->assertEquals(5, $out2[4]);
        $this->assertEquals(6, $out2[5]);
        $this->assertEquals(1, $out[0]);
        $this->assertEquals(2, $out[1]);
        $this->assertEquals(3, $out[2]);
        $this->assertEquals(4, $out[3]);
        $this->assertEquals(5, $out[4]);
        $this->assertEquals(6, $out[5]);
    }

    public function testFilter() {
        $this->fill(0,1,2,3,4,5);

        $count = 0;
        $out   = $this->implementation->filter(function($object, $index, $array) use(&$count) {
            $count++;

            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);
            return $object <= 3;
        });

        $this->assertEquals(6, $count);
        $this->assertEquals(0, $out[0]);
        $this->assertEquals(1, $out[1]);
        $this->assertEquals(2, $out[2]);
        $this->assertEquals(3, $out[3]);

        $count = 0;
        $out   = Arrays::filter($this->implementation, function($object, $index, $array) use(&$count) {
            $count++;

            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);
            return $object <= 3;
        });

        $this->assertEquals(6, $count);
        $this->assertEquals([0,1,2,3], $out);
    }

    public function testFirst() {
        $this->fill(1,2,3,4,5);

        $first = $this->implementation->first();
        $this->assertEquals(1, $first);

        $count = 0;
        $first = $this->implementation->first(function($object, $index, $array) use(&$count) {
            $count++;

            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);
            return $object === 5;
        });

        $this->assertEquals(5, $first);
        $this->assertEquals(5, $count);


        $first = Arrays::first($this->implementation);
        $this->assertEquals(1, $first);
        $count = 0;

        $first = Arrays::first($this->implementation, function($object, $index, $array) use(&$count) {
            $count++;

            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);
            return $object === 5;
        });

        $this->assertEquals(5, $first);
        $this->assertEquals(5, $count);

        $firstNull = $this->implementation->first(function($o) {
            return $o === 100;
        });

        $this->assertNull($firstNull);
    }


    public function testLast() {
        $this->fill(1,2,3,4,5);

        $last = $this->implementation->last();
        $this->assertEquals(5, $last);

        $count = 0;
        $last = $this->implementation->last(function($object, $index, $array) use(&$count) {
            $count++;

            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);
            return $object === 1;
        });

        $this->assertEquals(1, $last);
        $this->assertEquals(5, $count);


        $last = Arrays::last($this->implementation);
        $this->assertEquals(5, $last);
        $count = 0;

        $last = Arrays::last($this->implementation, function($object, $index, $array) use(&$count) {
            $count++;

            $this->assertEquals($object, $array[$index]);
            $this->assertNotNull($object);
            return $object === 1;
        });

        $this->assertEquals(1, $last);
        $this->assertEquals(5, $count);

        $lastNull = $this->implementation->last(function($o) {
            return false;
        });

        $this->assertNull($lastNull);
    }

    public function testGnomeSort() {
        $this->fill(2,6,3,5,8,23,1,1010);

        $out = $this->implementation->sort(function($a, $b) {
            return $a-$b;
        }, Arrays::GNOME_SORT);

        $this->assertEquals([
            1, 2, 3, 5, 6, 8, 23, 1010
        ], $out->toArray());
    }

    public function testQuickSort() {
        $this->fill(2,6,3,5,8,23,1,1010);

        $out = $this->implementation->sort(function($a, $b) {
            return $a-$b;
        }, Arrays::QUICK_SORT);

        $this->assertEquals([
            1, 2, 3, 5, 6, 8, 23, 1010
        ], $out->toArray());
    }

    public function testNativeSort() {
        $this->fill(2,6,3,5,8,23,1,1010);

        $out = $this->implementation->sort(function($a, $b) {
            return $a-$b;
        }, Arrays::NATIVE_SORT);

        $this->assertEquals([
            1, 2, 3, 5, 6, 8, 23, 1010
        ], $out->toArray());
    }

    public function testNativeSortArray() {
        $arr = [2,6,3,5,8,23,1,1010];

        $out = Arrays::sort($arr, function($a, $b) {
            return $a-$b;
        }, Arrays::NATIVE_SORT);

        $this->assertEquals([
            1, 2, 3, 5, 6, 8, 23, 1010
        ], $out);
    }


    public function testQuickSortArray() {
        $arr = [2,6,3,5,8,23,1,1010];

        $out = Arrays::sort($arr, function($a, $b) {
            return $a-$b;
        }, Arrays::QUICK_SORT);

        $this->assertEquals([
            1, 2, 3, 5, 6, 8, 23, 1010
        ], $out);
    }

    public function testGnomeSortArray() {
        $arr = [2,6,3,5,8,23,1,1010];

        $out = Arrays::sort($arr, function($a, $b) {
            return $a-$b;
        }, Arrays::GNOME_SORT);

        $this->assertEquals([
            1, 2, 3, 5, 6, 8, 23, 1010
        ], $out);
    }

    public function testSortNoComparatorNoMethod() {
        $arr = [2,6,3,5,8,23,1,1010];

        $out = Arrays::sort($arr);

        $this->assertEquals([
            1, 2, 3, 5, 6, 8, 23, 1010
        ], $out);

        $this->fill(2,6,3,5,8,23,1,1010);

        $out = $this->implementation->sort();

        $this->assertEquals([
            1, 2, 3, 5, 6, 8, 23, 1010
        ], $out->toArray());
    }

    public function testSortInvalidSort() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The argument for sortType (ABC123) is invalid.'
        );

        $this->implementation->sort(null, 'ABC123');
    }

}
