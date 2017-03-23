<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ListTestTrait.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays\Tests\Traits;

use Jitesoft\Utilities\Arrays\Contracts\ListInterface;

trait ListTestTrait {

    /** @var ListInterface */
    protected $implementation;

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

    public function testCount() {
        $this->assertEquals(0, $this->implementation->count());
        $this->implementation->add("hej");
        $this->assertEquals(1, $this->implementation->count());
        $this->implementation->addRange(["a", "b", "c"]);
        $this->assertEquals(4, $this->implementation->count());
        $this->implementation->remove("a");
        $this->assertEquals(3, $this->implementation->count());
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
}
