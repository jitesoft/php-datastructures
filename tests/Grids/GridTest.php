<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  GridTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Grids;

use Jitesoft\Utilities\DataStructures\Grids\Grid;
use Jitesoft\Utilities\Math\Vector2D;
use PHPUnit\Framework\TestCase;

/**
 * @group Grid
 */
class GridTest extends TestCase {

    /** @var Grid */
    protected $grid;

    public function setUp(): void {
        parent::setUp();

        $this->grid = new Grid(1024,512,50);
    }

    public function testGetCellCount() {
        $this->assertEquals(200, $this->grid->getCellCount());
    }

    public function testGetCellSize() {
        $this->assertEquals(50, $this->grid->getCellSize());
    }

    public function testGetGridWidth() {
        $this->assertEquals(1024, $this->grid->getGridWidth());
    }

    public function testGetGridHeight() {
        $this->assertEquals(512, $this->grid->getGridHeight());
    }

    public function testAddToCell() {
        $this->grid->addToCell('Object1', new Vector2D(137, 342));
        $this->grid->addToCell('Object2', new Vector2D(138, 342));
        $this->grid->addToCell('Object3', new Vector2D(42, 57));

        $this->assertEquals(2, $this->grid->getCell(new Vector2D(137, 342))->getObjects()->length());
        $this->assertEquals(1, $this->grid->getCell(new Vector2D(42, 57))->getObjects()->length());
        $this->assertEquals('Object1', $this->grid->getCell(new Vector2D(137, 342))->getObjects()[0]);
        $this->assertEquals('Object2', $this->grid->getCell(new Vector2D(137, 342))->getObjects()[1]);
    }

    public function testClearGrid() {
        $count = function() {
            $c = 0;
            for ($i = $this->grid->getCellCount();$i-- > 0;) {
                $c += $this->grid->getCell($i)->getObjects()->count();
            }
            return $c;
        };

        $this->assertEquals(0, $count());
        $this->grid->addToCell('Hej', new Vector2D(10, 8));
        $this->grid->addToCell('Hej2', new Vector2D(2,1));
        $this->grid->addToCell('Hej3', new Vector2D(8, 5));
        $this->assertEquals(3, $count());
        $this->grid->clearGrid();
        $this->assertEquals(0, $count());
    }

    public function testGetCell() {
        $this->grid->addToCell('New object!', new Vector2D(100, 400));

        $cellCountX = (int)(1024 / 50);
        $pos        = (100 / 50) + ((400 / 50) * $cellCountX);

        $g1 = $this->grid->getCell(new Vector2D(100, 400));
        $g2 = $this->grid->getCell($pos);

        $this->assertEquals($g1, $g2);
        $this->assertCount(1, $g1->getObjects());
        $this->assertEquals('New object!', $g1->getObjects()[0]);
    }

}
