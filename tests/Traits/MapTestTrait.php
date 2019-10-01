<?php /** @noinspection ALL */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  MapTestTrait.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Traits;

use Jitesoft\Exceptions\Logic\InvalidKeyException;
use Jitesoft\Utilities\DataStructures\Maps\MapInterface;

trait MapTestTrait {

    /** @var MapInterface */
    protected $implementation;

    public function testAdd() {
        $this->assertEmpty($this->implementation);
        $this->implementation->add('abc', 123);
        $this->implementation->add('efg', 'weeoo');
        $this->assertNotEmpty($this->implementation);
    }

    public function testAddKeyExists() {
        $this->implementation->add('abc', 123);
        $this->expectException(InvalidKeyException::class);
        $this->expectExceptionMessage('Key "abc" already exist.');
        $this->implementation->add('abc', 123);
    }

    public function testCount() {
        $this->assertCount(0, $this->implementation);
        $this->assertEquals(0, $this->implementation->count());
        $this->implementation->add('abc', 123);
        $this->assertCount(1, $this->implementation);
        $this->assertEquals(1, $this->implementation->count());
        $this->implementation->add('efg', 456);
        $this->assertCount(2, $this->implementation);
        $this->assertEquals(2, $this->implementation->count());
    }

    public function testSize() {
        $this->assertEquals(0, $this->implementation->size());
        $this->implementation->add('abc', 123);
        $this->assertEquals(1, $this->implementation->size());
        $this->implementation->add('efg', 456);
        $this->assertEquals(2, $this->implementation->size());
    }

    public function testLength() {
        $this->assertEquals(0, $this->implementation->length());
        $this->implementation->add('abc', 123);
        $this->assertEquals(1, $this->implementation->length());
        $this->implementation->add('efg', 456);
        $this->assertEquals(2, $this->implementation->length());
    }

    public function testClear() {
        $this->implementation->add('abc', 123);
        $this->implementation->add('efg', 456);
        $this->implementation->add('hij', 789);

        $this->assertCount(3, $this->implementation);
        $this->assertTrue($this->implementation->clear());
        $this->assertCount(0, $this->implementation);
        $this->assertEmpty($this->implementation);
    }

    public function testGet() {
        $this->implementation->add('abc', 123);
        $this->implementation->add('efg', 456);
        $this->implementation->add('hij', 789);

        $this->assertEquals(123, $this->implementation->get('abc'));
        $this->assertEquals(789, $this->implementation->get('hij'));
        $this->assertEquals(456, $this->implementation->get('efg'));
    }

    public function testGetNotExists() {
        $this->expectException(InvalidKeyException::class);
        $this->expectExceptionMessage('Key "abc" does not exist.');
        $this->implementation->get('abc');
    }

    public function testSet() {
        $this->implementation->add('test', 'value');
        $this->assertEquals('value', $this->implementation->get('test'));
        $this->implementation->set('test', 'new value');
        $this->assertEquals('new value', $this->implementation->get('test'));
    }

    public function testSetNewKey() {
        $this->implementation->set('new', 'value');
        $this->assertEquals('value', $this->implementation->get('new'));
    }

    public function testHas() {
        $this->implementation->add('key', 'value');
        $this->assertTrue($this->implementation->has('key'));
    }

    public function testHasNotInMap() {
        $this->assertFalse($this->implementation->has('key'));
    }

    public function testToAssocArray() {
        $this->implementation->add('key1', 'value1');
        $this->implementation->add('key2', 'value2');

        $this->assertEquals(
            [
                'key1' => 'value1',
                'key2' => 'value2'
            ], $this->implementation->toAssocArray()
        );
    }

    public function testKeys() {
        $this->implementation->add('key1', 'value1');
        $this->implementation->add('key2', 'value2');

        $keys = $this->implementation->keys();

        $this->assertTrue(in_array('key1', $keys->toArray()));
        $this->assertTrue(in_array('key2', $keys->toArray()));
        $this->assertCount(2, $keys);
    }

    public function testValues() {
        $this->implementation->add('key1', 'value1');
        $this->implementation->add('key2', 'value2');

        $values = $this->implementation->values();

        $this->assertTrue(in_array('value1', $values->toArray()));
        $this->assertTrue(in_array('value2', $values->toArray()));
        $this->assertCount(2, $values);
    }

    public function testUnset() {
        $this->implementation->add('key1', 'value1');
        $this->implementation->add('key2', 'value2');

        $this->assertCount(2, $this->implementation);
        $this->assertTrue($this->implementation->has('key2'));
        unset($this->implementation['key2']);
        $this->assertFalse($this->implementation->has('key2'));
        $this->assertCount(1, $this->implementation);
    }

    public function testArrayAccessSet() {
        $this->assertCount(0, $this->implementation);
        $this->implementation['test'] = 123;
        $this->assertCount(1, $this->implementation);
        $this->assertEquals(123, $this->implementation->get('test'));
    }

    public function testArrayAccessSetExists() {
        $this->implementation['test'] = 123;
        $this->assertEquals(123, $this->implementation->get('test'));
        $this->implementation['test'] = 'changed';
        $this->assertEquals('changed', $this->implementation->get('test'));
    }

    public function testArrayAccessGet() {
        $this->implementation->add('abc', 123);
        $this->implementation->add('efg', 456);

        $this->assertEquals(123, $this->implementation['abc']);
        $this->assertEquals(456, $this->implementation['efg']);
    }

    public function testArrayAccessGetInvalidKey() {
        $this->expectException(InvalidKeyException::class);
        $this->expectExceptionMessage('Key "abc" does not exist.');
        $this->implementation['abc'];
    }

}
