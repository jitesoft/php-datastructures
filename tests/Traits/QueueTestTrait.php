<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  QueueTestTrait.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Traits;

use Jitesoft\Utilities\DataStructures\Queues\QueueInterface;

trait QueueTestTrait {

    /** @var QueueInterface */
    protected $implementation;

    public function testEnqueue() {
        $this->assertEmpty($this->implementation);
        $this->assertTrue($this->implementation->enqueue("Test"));
        $this->assertCount(1, $this->implementation);
        $this->assertTrue($this->implementation->enqueue("Test2"));
        $this->assertCount(2, $this->implementation);
        $this->assertTrue($this->implementation->enqueue("Test3", "Test4"));
    }

    public function testDequeue() {
        $this->implementation->enqueue("A", "B", "C");
        $this->implementation->enqueue("D");

        $this->assertCount(4, $this->implementation);
        $this->assertEquals("A", $this->implementation->dequeue());
        $this->assertCount(3, $this->implementation);
        $this->assertEquals("B", $this->implementation->dequeue());
        $this->assertEquals("C", $this->implementation->dequeue());
        $this->assertCount(1, $this->implementation);
        $this->assertEquals("D", $this->implementation->dequeue());
        $this->assertEmpty($this->implementation);
    }

    public function testDequeueEmpty() {
        $this->assertNull($this->implementation->dequeue());
    }

    public function testPeek() {
        $this->implementation->enqueue("A", "B", "C");
        $this->implementation->enqueue("D");
        $this->assertCount(4, $this->implementation);
        $this->assertEquals("A", $this->implementation->peek());
        $this->assertCount(4, $this->implementation);
        $this->assertEquals("A", $this->implementation->peek());
        $this->implementation->dequeue();
        $this->assertEquals("B", $this->implementation->peek());
        $this->assertCount(3, $this->implementation);
    }

    public function testPeekEmpty() {
        $this->assertNull($this->implementation->peek());
    }

    public function testLength() {
        $this->assertEquals(0, $this->implementation->length());
        $this->implementation->enqueue("Test");
        $this->implementation->enqueue("TEST");
        $this->implementation->enqueue("test...");
        $this->assertEquals(3, $this->implementation->length());
        $this->implementation->dequeue();
        $this->assertEquals(2, $this->implementation->length());
    }

    public function testSize() {
        $this->assertEquals(0, $this->implementation->size());
        $this->implementation->enqueue("Test");
        $this->implementation->enqueue("TEST");
        $this->implementation->enqueue("test...");
        $this->assertEquals(3, $this->implementation->size());
        $this->implementation->dequeue();
        $this->assertEquals(2, $this->implementation->size());
    }

    public function testCount() {
        $this->assertEquals(0, $this->implementation->count());
        $this->implementation->enqueue("Test");
        $this->implementation->enqueue("TEST");
        $this->implementation->enqueue("test...");
        $this->assertEquals(3, $this->implementation->count());
        $this->implementation->dequeue();
        $this->assertEquals(2, $this->implementation->count());
    }

    public function testCountable() {
        $this->assertCount(0, $this->implementation);
        $this->implementation->enqueue("Test");
        $this->implementation->enqueue("TEST");
        $this->implementation->enqueue("test...");
        $this->assertCount(3, $this->implementation);
        $this->implementation->dequeue();
        $this->assertCount(2, $this->implementation);
    }

    public function testClear() {
        $this->implementation->enqueue("a", "b", "c");
        $this->assertCount(3, $this->implementation);
        $this->implementation->clear();
        $this->assertCount(0, $this->implementation);
        $this->assertEmpty($this->implementation);
    }
}
