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
        $this->getSelf()->expectException(InvalidArgumentException::class);
        $this->getSelf()->expectExceptionMessage("Invalid indexer access. Argument was not of integer type.");
        $this->implementation["test"];
    }

    public function testArrayAccessOutOfBoundsUnder() {

        $this->implementation[0] = "Test";
        $this->getSelf()->expectException(OutOfBoundsException::class);
        $this->getSelf()->expectExceptionMessage("Array out of bounds.");

        $value = $this->implementation[-1];
    }

    public function testArrayAccessOutOfBoundsOver() {
        $this->getSelf()->expectException(OutOfBoundsException::class);
        $this->getSelf()->expectExceptionMessage("Array out of bounds.");

        $value = $this->implementation[1];

    }

    public function testAdd() {
        $this->implementation->add("Test");
        $this->implementation->add("Test2");

        $this->getSelf()->assertEquals("Test", $this->implementation[0]);
        $this->getSelf()->assertEquals("Test2", $this->implementation[1]);
    }

    public function testInsert() {
        $this->implementation->add("One");
        $this->implementation->add("Three");

        $this->getSelf()->assertEquals("One", $this->implementation[0]);
        $this->getSelf()->assertEquals("Three", $this->implementation[1]);

        $this->implementation->insert("Two", 1);

        $this->getSelf()->assertEquals("One", $this->implementation[0]);
        $this->getSelf()->assertEquals("Two", $this->implementation[1]);
        $this->getSelf()->assertEquals("Three", $this->implementation[2]);
    }

    public function testInsertOutOfBounds() {
        $this->getSelf()->expectException(OutOfBoundsException::class);
        $this->getSelf()->expectExceptionMessage("Array out of bounds.");

        $this->implementation->insert("Test", 10);
    }

    public function testAddRange() {
        $this->implementation->add("Test");
        $this->implementation->add("Test2");

        $this->getSelf()->assertEquals("Test", $this->implementation[0]);
        $this->getSelf()->assertEquals("Test2", $this->implementation[1]);
        $this->getSelf()->assertFalse(isset($this->implementation[2]));

        $this->implementation->addRange(array(
            "Test3",
            "Test4"
        ));

        $this->getSelf()->assertEquals("Test", $this->implementation[0]);
        $this->getSelf()->assertEquals("Test2", $this->implementation[1]);
        $this->getSelf()->assertEquals("Test3", $this->implementation[2]);
        $this->getSelf()->assertEquals("Test4", $this->implementation[3]);
    }

    public function testInsertRange() {
        $this->implementation->add("Test");
        $this->implementation->add("Test2");

        $this->getSelf()->assertEquals("Test", $this->implementation[0]);
        $this->getSelf()->assertEquals("Test4", $this->implementation[1]);
        $this->getSelf()->assertFalse(isset($this->implementation[2]));

        $this->implementation->insertRange(array(
            "Test2",
            "Test3"
        ), 1);

        $this->getSelf()->assertEquals("Test", $this->implementation[0]);
        $this->getSelf()->assertEquals("Test2", $this->implementation[1]);
        $this->getSelf()->assertEquals("Test3", $this->implementation[2]);
        $this->getSelf()->assertEquals("Test4", $this->implementation[3]);
    }

    public function testRemoveInvalid() {
        $this->getSelf()->assertFalse($this->implementation->remove("Test"));
    }

    public function testRemoveValid() {
        $this->implementation->add("Test");
        $this->getSelf()->assertTrue(isset($this->implementation[0]));
        $this->getSelf()->assertTrue($this->implementation->remove("Test"));
        $this->getSelf()->assertFalse(isset($this->implementation[0]));
    }

    public function testRemoveAtOutOfBounds() {
        $this->getSelf()->expectException(OutOfBoundsException::class);
        $this->getSelf()->expectExceptionMessage("Array out of bounds.");
        $this->implementation->removeAt(3);
    }

    public function testRemoveAtValidNotCyclic() {
        $this->implementation[0] = "Test";
        $this->implementation[1] = "Test1";
        $this->implementation[2] = "Test2";
        $this->implementation[3] = "Test3";
        $this->getSelf()->assertTrue($this->implementation->removeAt(1));

        $this->getSelf()->assertEquals("Test", $this->implementation[0]);
        $this->getSelf()->assertEquals("Test3", $this->implementation[1]);
        $this->getSelf()->assertEquals("Test2", $this->implementation[2]);
        $this->getSelf()->assertFalse(isset($this->implementation[0]));
    }


    public function testRemoveAtValidCyclic() {
        $this->implementation[0] = "Test";
        $this->implementation[1] = "Test1";
        $this->implementation[2] = "Test2";
        $this->implementation[3] = "Test3";
        $this->getSelf()->assertTrue($this->implementation->removeAt(1, true));

        $this->getSelf()->assertEquals("Test", $this->implementation[0]);
        $this->getSelf()->assertEquals("Test2", $this->implementation[1]);
        $this->getSelf()->assertEquals("Test3", $this->implementation[2]);
        $this->getSelf()->assertFalse(isset($this->implementation[0]));
    }

    /**
     * @return TestCase $this
     */
    private function getSelf() {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this;
    }

}
