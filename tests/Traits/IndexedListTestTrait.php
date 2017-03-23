<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  IndexedListTestTrait.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Traits;

use InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Contracts\IndexedListInterface;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

trait IndexedListTestTrait {
    use ListTestTrait;

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

        $this->implementation->insert("Hi", 2);

        $this->assertCount(4, $this->implementation);

        $this->assertEquals("One", $this->implementation[0]);
        $this->assertEquals("Two", $this->implementation[1]);
        $this->assertEquals("Hi", $this->implementation[2]);
        $this->assertEquals("Three", $this->implementation[3]);
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

        $this->assertTrue($this->implementation->insertRange(array(
            "Test2",
            "Test3"
        ), 1));

        $this->assertEquals("Test", $this->implementation[0]);
        $this->assertEquals("Test2", $this->implementation[1]);
        $this->assertEquals("Test3", $this->implementation[2]);
        $this->assertEquals("Test4", $this->implementation[3]);
        $this->assertCount(4, $this->implementation);

        $this->assertTrue($this->implementation->insertRange(array(
            "Hej",
            "Whoop"
        ), 2));
        $this->assertCount(6, $this->implementation);

        $this->assertEquals("Test", $this->implementation[0]);
        $this->assertEquals("Test2", $this->implementation[1]);
        $this->assertEquals("Hej", $this->implementation[2]);
        $this->assertEquals("Whoop", $this->implementation[3]);
        $this->assertEquals("Test3", $this->implementation[4]);
        $this->assertEquals("Test4", $this->implementation[5]);
    }

    public function testRemoveInvalid() {
        $this->assertFalse($this->implementation->remove("Test"));
        $this->implementation->add("Test");
        $this->assertFalse($this->implementation->remove("Test2"));
        $this->assertCount(1, $this->implementation);
    }

    public function testRemoveValid() {
        $this->implementation->add("Test");
        $this->implementation->add("Test2");
        $this->assertCount(2, $this->implementation);
        $this->assertTrue($this->implementation->remove("Test"));
        $this->assertCount(1, $this->implementation);
        $this->assertEquals("Test2", $this->implementation[0]);
        $this->assertTrue($this->implementation->remove("Test2"));
        $this->assertCount(0, $this->implementation);
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
        $this->assertTrue($this->implementation->removeAt(1, false));

        $this->assertEquals("Test", $this->implementation[0]);
        $this->assertEquals("Test3", $this->implementation[1]);
        $this->assertEquals("Test2", $this->implementation[2]);
        $this->assertFalse(isset($this->implementation[3]));
        $this->assertCount(3, $this->implementation);

        $this->assertTrue($this->implementation->removeAt(0, false));
        $this->assertCount(2, $this->implementation);
        $this->assertEquals("Test2", $this->implementation[0]);
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

        $this->assertTrue($this->implementation->removeAt(0, true));
        $this->assertEquals("Test2", $this->implementation[0]);
        $this->assertCount(2, $this->implementation);
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
