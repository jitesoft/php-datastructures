<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  MapMethodsTestTrait.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Tests\Traits;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Maps;
use Jitesoft\Utilities\DataStructures\Maps\MapInterface;
use Jitesoft\Utilities\DataStructures\Traits\MapMethodsTrait;

trait MapMethodsTestTrait {

    /**
     * @var MapMethodsTrait|MapInterface
     */
    protected $implementation;

    private function fill(array $arr) {
        foreach ($arr as $key => $value) {
            $this->implementation->add($key, $value);
        }
    }

    public function testForEach() {
        $this->fill(["ONE" => "one", "TWO" => "two", "THREE" => "three"]);

        $count = 0;
        $this->implementation->forEach(function($value, $key, $list) use(&$count) {
            $this->assertNotNull($value);
            $this->assertTrue(isset($list[$key]));
            $this->assertSame($value, $list[$key]);
            $count++;
        });

        $this->assertEquals(3, $count);

        $count = 0;
        Maps::forEach($this->implementation, function($value, $key, $list) use(&$count) {
            $this->assertNotNull($value);
            $this->assertTrue(isset($list[$key]));
            $this->assertSame($value, $list[$key]);
            $count++;
        });

        $this->assertEquals(3, $count);
    }

    public function testForEachWithBreak() {
        $this->fill(["ONE" => "one", "TWO" => "two", "THREE" => "three"]);

        $count = 0;
        $this->implementation->forEach(function($value) use(&$count) {
            if ($value === "three") {
                return false;
            }
            $count++;
            return true;
        });

        $this->assertEquals(2, $count);

        $count = 0;
        Maps::forEach($this->implementation, function($value) use(&$count) {
            if ($value === "three") {
                return false;
            }
            $count++;
            return true;
        });

        $this->assertEquals(2, $count);
    }

    public function testMap() {
        $this->fill([ 1 => 2, 3 => 4, 5 => 6 ]);

        $count = 0;
        $out   = $this->implementation->map(function($value, $key, $map) use(&$count) {
            $this->assertEquals($value, $map[$key]);
            $this->assertNotNull($value);

            $count++;

            return $value + $key;
        });

        $this->assertEquals(3, $count);

        $count = 0;
        $out2  = Maps::map($this->implementation, function($value, $key, $map) use(&$count) {
            $this->assertEquals($value, $map[$key]);
            $this->assertNotNull($value);

            $count++;

            return $value + $key;
        });

        $this->assertEquals(3, $count);

        $this->assertEquals(3, $out[1]);
        $this->assertEquals(3, $out2[1]);
        $this->assertEquals(7, $out[3]);
        $this->assertEquals(7, $out2[3]);
        $this->assertEquals(11, $out[5]);
        $this->assertEquals(11, $out2[5]);

        $this->assertEquals(3, $this->implementation->count());
    }

    public function testMapArray() {
        $arr   = [ 1 => 2, 3 => 4, 5 => 6 ];
        $count = 0;
        $out   = Maps::map($arr, function($value, $key, $map) use(&$count) {
            $this->assertEquals($value, $map[$key]);
            $this->assertNotNull($value);

            $count++;

            return $value + $key;
        });

        $this->assertEquals(3, $count);
        $this->assertEquals(3, $out[1]);
        $this->assertEquals(7, $out[3]);
        $this->assertEquals(11, $out[5]);
    }

    public function testFilter() {
        $this->fill([ 1 => 2, 3 => 4, 5 => 6 ]);

        $count = 0;
        $out   = $this->implementation->filter(function($value, $key, $map) use(&$count) {
            $count++;

            $this->assertEquals($value, $map[$key]);
            $this->assertNotNull($value);
            return $value <= 4;
        });

        $this->assertEquals(3, $count);
        $this->assertEquals(2, $out[1]);
        $this->assertEquals(4, $out[3]);
        $this->assertFalse($out->has(5));

        $count = 0;
        $out   = Maps::filter($this->implementation, function($value, $key, $map) use(&$count) {
            $count++;

            $this->assertEquals($value, $map[$key]);
            $this->assertNotNull($value);
            return $value <= 4;
        });

        $this->assertEquals(3, $count);
        $this->assertEquals(2, $out[1]);
        $this->assertEquals(4, $out[3]);
        $this->assertFalse($out->has(5));
    }

    public function testFilterArray() {
        $arr   = [ 1 => 2, 3 => 4, 5 => 6 ];
        $count = 0;
        $out   = Maps::filter($arr, function($value, $key, $map) use(&$count) {
            $count++;

            $this->assertEquals($value, $map[$key]);
            $this->assertNotNull($value);
            return $value <= 4;
        });

        $this->assertEquals(3, $count);
        $this->assertEquals(2, $out[1]);
        $this->assertEquals(4, $out[3]);
        $this->assertFalse(array_key_exists(5, $out));
    }


    public function testFirst() {
        $this->fill([ 1 => 2, 3 => 4, 5 => 6 ]);

        $count = 0;
        $first = $this->implementation->first(function($value, $key, $map) use(&$count) {
            $count++;

            $this->assertEquals($value, $map[$key]);
            $this->assertNotNull($value);
            return $key === 5;
        });

        $this->assertEquals(6, $first);
        $this->assertEquals(3, $count);

        $count = 0;
        $first = Maps::first($this->implementation, function($value, $key, $map) use(&$count) {
            $count++;

            $this->assertEquals($value, $map[$key]);
            $this->assertNotNull($value);
            return $key === 5;
        });

        $this->assertEquals(6, $first);
        $this->assertEquals(3, $count);

        $firstNull = $this->implementation->first(function($o) {
            return $o === 100;
        });

        $this->assertNull($firstNull);
    }


    public function testLast() {
        $this->fill([ 1 => 2, 3 => 4, 5 => 6 ]);

        $count = 0;
        $last  = $this->implementation->last(function($value, $key, $map) use(&$count) {
            $count++;

            $this->assertEquals($value, $map[$key]);
            $this->assertNotNull($value);
            return $key === 1;
        });

        $this->assertEquals(2, $last);
        $this->assertEquals(3, $count);


        $count = 0;
        $last  = Maps::last($this->implementation, function($value, $key, $map) use(&$count) {
            $count++;

            $this->assertEquals($value, $map[$key]);
            $this->assertNotNull($value);
            return $key === 1;
        });

        $this->assertEquals(2, $last);
        $this->assertEquals(3, $count);

        $lastNull = $this->implementation->last(function($o) {
            return false;
        });

        $this->assertNull($lastNull);
    }

    public function testInvalidArgForeach() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed argument was not a map.');
        Maps::forEach("string!", function () {});
    }

    public function testInvalidArgMap() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed argument was not a map.');
        Maps::map("string!", function () {});
    }

    public function testInvalidArgFirst() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed argument was not a map.');
        Maps::first("string!", function () {});
    }

    public function testInvalidArgLast() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed argument was not a map.');
        Maps::last("string!", function () {});
    }
    public function testInvalidArgFilter() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed argument was not a map.');
        Maps::filter("string!", function () {});
    }
}
