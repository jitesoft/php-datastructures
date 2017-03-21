<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  IndexedArrayTestTrait.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays\Tests\Traits;

use InvalidArgumentException;
use Jitesoft\Utilities\Arrays\Contracts\IndexedListInterface;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

trait IndexedArrayTestTrait {

    /** @var IndexedListInterface */
    protected $implementation;

    public function testArrayAccessWithIndexes() {
        $this->implementation[0] = "Test1";
        $this->implementation[1] = "Test2";

        TestCase::assertEquals("Test1", $this->implementation[0]);
        TestCase::assertEquals("Test2", $this->implementation[1]);
    }

    public function testArrayAccessWithInvalidType() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid indexer access. Argument was not of integer type.");
        $this->implementation["test"];
    }

    public function testArrayAccessOutOfBoundsUnder() {

        $this->implementation[0] = "Test";
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Array out of bounds.");

        $value = $this->implementation[-1];
    }

    public function testArrayAccessOutOfBoundsOver() {
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Array out of bounds.");

        $value = $this->implementation[1];

    }

    public function testAdd() {
        $this->implementation->add("Test");
        $this->implementation->add("Test2");

        $this->assertEquals("Test", $this->implementation[0]);
        $this->assertEquals("Test2", $this->implementation[1]);
    }

    public function testInsert() {
        $this->implementation->add("One");
        $this->implementation->add("Three");

        $this->assertEquals("One", $this->implementation[0]);
        $this->assertEquals("Three", $this->implementation[1]);

        $this->implementation->insert("Two", 1);

        $this->assertEquals("One", $this->implementation[0]);
        $this->assertEquals("Two", $this->implementation[1]);
        $this->assertEquals("Three", $this->implementation[2]);
    }

    public function testInsertOutOfBounds() {
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Array out of bounds.");

        $this->implementation->insert("Test", 10);
    }

    public function testAddRange() {
        $this->implementation->add("Test");
        $this->implementation->add("Test2");

        $this->assertEquals("Test", $this->implementation[0]);
        $this->assertEquals("Test2", $this->implementation[1]);
        $this->assertFalse(isset($this->implementation[2]));

        $this->implementation->addRange(array(
            "Test3",
            "Test4"
        ));

        $this->assertEquals("Test", $this->implementation[0]);
        $this->assertEquals("Test2", $this->implementation[1]);
        $this->assertEquals("Test3", $this->implementation[2]);
        $this->assertEquals("Test4", $this->implementation[3]);
    }

    public function testInsertRange() {
        $this->implementation->add("Test");
        $this->implementation->add("Test4");

        $this->assertEquals("Test", $this->implementation[0]);
        $this->assertEquals("Test4", $this->implementation[1]);
        $this->assertFalse(isset($this->implementation[2]));

        $this->implementation->insertRange(array(
            "Test2",
            "Test3"
        ), 1);

        $this->assertEquals("Test", $this->implementation[0]);
        $this->assertEquals("Test2", $this->implementation[1]);
        $this->assertEquals("Test3", $this->implementation[2]);
        $this->assertEquals("Test4", $this->implementation[3]);
    }

    public function testRemoveInvalid() {
        $this->assertFalse($this->implementation->remove("Test"));
    }

    public function testRemoveValid() {
        $this->implementation->add("Test");
        $this->assertTrue(isset($this->implementation[0]));
        $this->assertTrue($this->implementation->remove("Test"));
        $this->assertFalse(isset($this->implementation[0]));
    }

    public function testRemoveAtOutOfBounds() {
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage("Array out of bounds.");
        $this->implementation->removeAt(3);
    }

    public function testRemoveAtValidNotCyclic() {
        $this->implementation[0] = "Test";
        $this->implementation[1] = "Test1";
        $this->implementation[2] = "Test2";
        $this->implementation[3] = "Test3";
        $this->assertTrue($this->implementation->removeAt(1));

        $this->assertEquals("Test", $this->implementation[0]);
        $this->assertEquals("Test3", $this->implementation[1]);
        $this->assertEquals("Test2", $this->implementation[2]);
        $this->assertFalse(isset($this->implementation[3]));
    }


    public function testRemoveAtValidCyclic() {
        $this->implementation[0] = "Test";
        $this->implementation[1] = "Test1";
        $this->implementation[2] = "Test2";
        $this->implementation[3] = "Test3";
        $this->assertTrue($this->implementation->removeAt(1, true));

        $this->assertEquals("Test", $this->implementation[0]);
        $this->assertEquals("Test2", $this->implementation[1]);
        $this->assertEquals("Test3", $this->implementation[2]);
        $this->assertFalse(isset($this->implementation[3]));
    }


    public function testCount() {
        $this->assertEquals(0, $this->implementation->count());
        $this->implementation->add("hej");
        $this->assertEquals(1, $this->implementation->count());
        $this->implementation->addRange(["a", "b", "c"]);
        $this->assertEquals(4, $this->implementation->count());
        $this->implementation->remove("a");
        $this->assertEquals(3, $this->implementation->count());
    }

    public function testLength() {
        $this->assertEquals(0, $this->implementation->length());
        $this->implementation[0] = "Test";
        $this->implementation[1] = "TEST";
        $this->implementation->insert("test...", 1);
        $this->assertEquals(3, $this->implementation->length());
        $this->implementation->removeAt(1);
        $this->assertEquals(2, $this->implementation->length());
    }

    public function testSize() {
        $this->assertEquals(0, $this->implementation->size());
        $this->implementation->insertRange(["a", "b", "c"], 0);
        $this->assertEquals(3, $this->implementation->size());
        $this->implementation->removeAt(2);
        $this->assertEquals(2, $this->implementation->size());
    }

    public function testCountable() {
        $this->assertCount(0, $this->implementation);
        $this->assertEquals(0, count($this->implementation));
        $this->implementation->addRange(["a","b", 3]);
        $this->assertCount(3, $this->implementation);
        $this->assertEquals(3, count($this->implementation));
    }

    public function testClear() {
        $this->implementation->addRange(["a", "b", "c"]);
        $this->assertCount(3, $this->implementation);
        $this->implementation->clear();
        $this->assertCount(0, $this->implementation);
        $this->assertEmpty($this->implementation);
    }

    public function testUnset() {
        $this->implementation->addRange(["a", "b", "c", "d", "e"]);
        $this->assertTrue(isset($this->implementation[1]));
        unset($this->implementation[1]);
        $this->assertCount(4, $this->implementation);
        $this->assertEquals("a", $this->implementation[0]);
        $this->assertEquals("c", $this->implementation[1]);
        $this->assertEquals("d", $this->implementation[2]);
        $this->assertEquals("e", $this->implementation[3]);
        $this->assertFalse(isset($this->implementation[4]));
    }
}
