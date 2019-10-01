<?php /** @noinspection ALL */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  NodeTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Internal;

use Jitesoft\Exceptions\Logic\OutOfBoundsException;
use Jitesoft\Utilities\DataStructures\Internal\Node;
use PHPUnit\Framework\TestCase;
use Jitesoft\Exceptions\Logic\InvalidArgumentException;

/**
 * @group LinkedStructures
 */
class NodeTest extends TestCase {

    public function testSingleLink() {
        $node = new Node('Hej', 1);
        $this->assertNull($node->getLink(0));

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('This node only have 1 link.');
        $node->getLink(1);
    }

    public function testMultiLink() {
        $node = new Node('Hej', 3);
        $this->assertNull($node->getLink(0));
        $this->assertNull($node->getLink(1));
        $this->assertNull($node->getLink(2));

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('This node only have 3 links.');
        $node->getLink(3);
    }

    public function testGetItem() {
        $node = new Node('Hej', 1);
        $this->assertEquals('Hej', $node->getItem());
        $node = new Node(123, 1);
        $this->assertEquals(123, $node->getItem());
    }

    public function testSetLink() {
        $node = new Node('Hej', 1);
        $node->setLink(0, new Node('Hej2', 1));
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('This node only have 1 link.');
        $node->setLink(1, new Node('Hej3', 1));
    }

    public function testGetLink() {
        $node = new Node('Hej', 1);
        $node->setLink(0, new Node('Hej2', 1));
        $this->assertNotNull($node->getLink(0));
        $this->assertEquals('Hej2', $node->getLink(0)->getItem());
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('This node only have 1 link.');
        $node->getLink(1);
    }

    public function testSetItem() {
        $node = new Node('Hej', 1);
        $this->assertEquals('Hej', $node->getItem());
        $node->setItem('Hej2');
        $this->assertEquals('Hej2', $node->getItem());
    }

}
