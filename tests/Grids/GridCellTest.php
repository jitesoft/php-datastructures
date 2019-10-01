<?php /** @noinspection ALL */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  GridCellTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Grids;

use Jitesoft\Utilities\DataStructures\Grids\GridCell;
use Jitesoft\Utilities\DataStructures\Grids\GridCellInterface;
use Jitesoft\Utilities\Math\Vector2D;
use PHPUnit\Framework\TestCase;

/**
 * @group Grid
 */
class GridCellTest extends TestCase {

    /** @var GridCellInterface */
    protected $cell;

    public function setUp(): void {
        parent::setUp();
        $this->cell = new GridCell(3, 4, 5, new Vector2D(20, 20));
    }

    public function testGetIndexX() {
        $this->assertEquals(3, $this->cell->getIndexX());
    }

    public function testGetIndexY() {
        $this->assertEquals(4, $this->cell->getIndexY());
    }

    public function testGetObjects() {
        $this->assertCount(0, $this->cell->getObjects());
        $this->cell->add('test obhect');
        $this->cell->add('test obhect2');
        $this->assertCount(2, $this->cell->getObjects());

        $this->assertEquals('test obhect', $this->cell->getObjects()[0]);
        $this->assertEquals('test obhect2', $this->cell->getObjects()[1]);
    }

    public function testAdd() {
        $this->assertCount(0, $this->cell->getObjects());
        $this->cell->add('Object1');
        $this->assertCount(1, $this->cell->getObjects());
        $this->cell->add('Object2');
        $this->assertCount(2, $this->cell->getObjects());
        $this->assertEquals('Object1', $this->cell->getObjects()[0]);
        $obj = new class() {};

        $this->cell->add($obj);
        $this->assertCount(3, $this->cell->getObjects());
        $this->assertSame($obj, $this->cell->getObjects()[2]);
    }

    public function testInsert() {
        $this->cell->add('object1');
        $this->cell->add('object2');

        $this->assertCount(2, $this->cell->getObjects());
        $this->assertEquals('object1', $this->cell->getObjects()[0]);
        $this->assertEquals('object2', $this->cell->getObjects()[1]);

        $this->cell->insert('in-the-middle', 1);

        $this->assertCount(3, $this->cell->getObjects());
        $this->assertEquals('object1', $this->cell->getObjects()[0]);
        $this->assertEquals('in-the-middle', $this->cell->getObjects()[1]);
        $this->assertEquals('object2', $this->cell->getObjects()[2]);
    }

    public function testRemove() {
        $this->cell->add('one');
        $this->cell->add('two');
        $this->cell->add('three');

        $this->assertCount(3, $this->cell->getObjects());
        $this->assertEquals('one', $this->cell->getObjects()[0]);
        $this->assertEquals('two', $this->cell->getObjects()[1]);
        $this->assertEquals('three', $this->cell->getObjects()[2]);

        $this->cell->remove('two');

        $this->assertCount(2, $this->cell->getObjects());
        $this->assertEquals('one', $this->cell->getObjects()[0]);
        $this->assertEquals('three', $this->cell->getObjects()[1]);
    }

    public function testRemoveAt() {
        $this->cell->add('one');
        $this->cell->add('two');
        $this->cell->add('three');

        $this->assertCount(3, $this->cell->getObjects());
        $this->assertEquals('one', $this->cell->getObjects()[0]);
        $this->assertEquals('two', $this->cell->getObjects()[1]);
        $this->assertEquals('three', $this->cell->getObjects()[2]);

        $this->cell->removeAt(1);

        $this->assertCount(2, $this->cell->getObjects());
        $this->assertEquals('one', $this->cell->getObjects()[0]);
        $this->assertEquals('three', $this->cell->getObjects()[1]);
    }

    public function testClear() {
        $this->cell->add('one');
        $this->cell->add('two');
        $this->cell->add('three');
        $this->assertCount(3, $this->cell->getObjects());
        $this->cell->clear();
        $this->assertCount(0, $this->cell->getObjects());
    }

    public function testGetRadius() {
        $this->assertEqualsWithDelta(3.5355, $this->cell->getRadius(), 4, '');
    }

    public function testGetCenter() {
        $this->assertEquals(new Vector2D(20, 20), $this->cell->getCenter());
    }

    public function testGetPosition() {
        $this->assertEquals(new Vector2D(20, 20), $this->cell->getPosition());
    }

}
