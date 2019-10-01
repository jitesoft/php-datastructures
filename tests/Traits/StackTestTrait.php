<?php /** @noinspection ALL */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  StackTestTrait.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Traits;

use Jitesoft\Utilities\DataStructures\Stacks\StackInterface;

trait StackTestTrait {

    /** @var StackInterface */
    protected $implementation;

    public function testEnqueue() {
        $this->assertEmpty($this->implementation);
        $this->assertTrue($this->implementation->push('Test'));
        $this->assertCount(1, $this->implementation);
        $this->assertTrue($this->implementation->push('Test2'));
        $this->assertCount(2, $this->implementation);
        $this->assertTrue($this->implementation->push('Test3', 'Test4'));
    }

    public function testPop() {
        $this->implementation->push('A', 'B', 'C');
        $this->implementation->push('D');

        $this->assertCount(4, $this->implementation);
        $this->assertEquals('D', $this->implementation->pop());
        $this->assertCount(3, $this->implementation);
        $this->assertEquals('C', $this->implementation->pop());
        $this->assertEquals('B', $this->implementation->pop());
        $this->assertCount(1, $this->implementation);
        $this->assertEquals('A', $this->implementation->pop());
        $this->assertEmpty($this->implementation);
    }

    public function testPopEmpty() {
        $this->assertNull($this->implementation->pop());
    }

    public function testPeek() {
        $this->implementation->push('A', 'B', 'C');
        $this->implementation->push('D');
        $this->assertCount(4, $this->implementation);
        $this->assertEquals('D', $this->implementation->peek());
        $this->assertCount(4, $this->implementation);
        $this->assertEquals('D', $this->implementation->peek());
        $this->implementation->pop();
        $this->assertEquals('C', $this->implementation->peek());
        $this->assertCount(3, $this->implementation);
    }

    public function testPeekEmpty() {
        $this->assertNull($this->implementation->peek());
    }

    public function testLength() {
        $this->assertEquals(0, $this->implementation->length());
        $this->implementation->push('Test', 'TEST', 'Test....');
        $this->assertEquals(3, $this->implementation->length());
        $this->implementation->pop();
        $this->assertEquals(2, $this->implementation->length());
    }

    public function testSize() {
        $this->assertEquals(0, $this->implementation->size());
        $this->implementation->push('Test', 'TEST', 'Test....');
        $this->assertEquals(3, $this->implementation->size());
        $this->implementation->pop();
        $this->assertEquals(2, $this->implementation->size());
    }

    public function testCount() {
        $this->assertEquals(0, $this->implementation->count());
        $this->implementation->push('Test', 'TEST', 'Test....');
        $this->assertEquals(3, $this->implementation->count());
        $this->implementation->pop();
        $this->assertEquals(2, $this->implementation->count());
    }

    public function testCountable() {
        $this->assertCount(0, $this->implementation);
        $this->implementation->push('Test', 'TEST', 'Test....');
        $this->assertCount(3, $this->implementation);
        $this->implementation->pop();
        $this->assertCount(2, $this->implementation);
    }

    public function testClear() {
        $this->implementation->push('a', 'b', 'c');
        $this->assertCount(3, $this->implementation);
        $this->implementation->clear();
        $this->assertCount(0, $this->implementation);
        $this->assertEmpty($this->implementation);
    }

}
