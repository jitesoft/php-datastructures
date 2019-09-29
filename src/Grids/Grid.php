<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Grid.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Grids;

use Jitesoft\Utilities\DataStructures\Lists\IndexedList;
use Jitesoft\Utilities\DataStructures\Lists\ListInterface;
use Jitesoft\Utilities\Math\Vector2D;

/**
 * Class Grid
 *
 * A 2D grid using a IndexedList as a base structure.
 */
class Grid implements GridInterface {

    /** @var integer */
    protected $width;
    /** @var integer */
    protected $height;
    /** @var integer */
    protected $cellSize;
    /** @var integer */
    protected $cellCountX;
    /** @var integer */
    protected $cellCountY;
    /** @var ListInterface|GridCell[] */
    protected $cells;

    /**
     * Constructor.
     *
     * @param integer $sizeX    Horizontal size in full units.
     * @param integer $sizeY    Vertical size in full units.
     * @param integer $cellSize Size of the cells in full units.
     */
    public function __construct(int $sizeX, int $sizeY, int $cellSize) {
        $this->width      = $sizeX;
        $this->height     = $sizeY;
        $this->cellSize   = $cellSize;
        $this->cellCountX = (int)($sizeX / $cellSize);
        $this->cellCountY = (int)($sizeY / $cellSize);
        $this->cells      = new IndexedList();
        $startPoint       = new Vector2D(0, 0); // Upper right.

        for ($x = 0;$x < $this->cellCountX;$x++) {
            for ($y = 0;$y < $this->cellCountY;$y++) {
                $this->cells->add(new GridCell($x, $y, $cellSize, $startPoint));
                $startPoint['x'] += $cellSize;
            }
            $startPoint['x']  = 0;
            $startPoint['y'] += $cellSize;
        }
    }

    /**
     * Insert a object into a cell or multiple cells.
     *
     * @param mixed    $object   Object to insert.
     * @param Vector2D $position Position to add object to.
     * @return boolean
     */
    public function addToCell($object, Vector2D $position): bool {
        return $this->getCell($position)->add($object);
    }

    /**
     * Remove all items from all grid cells.
     *
     * @return boolean
     */
    public function clearGrid(): bool {
        $result = true;
        for ($i = $this->cells->length();$i-- > 0;) {
            $result = ($result === false ? false : $this->cells[$i]->clear());
        }
        return $result;
    }

    /**
     * Get a single sell by position or index.
     *
     * @param integer|Vector2D $position Position either as a index or as a vector position.
     * @return GridCellInterface|null
     */
    public function getCell($position): ?GridCellInterface {
        if (is_int($position)) {
            return $this->cells[$position];
        }

        $x = (int)$position['x'] / $this->cellSize;
        $y = (int)$position['y'] / $this->cellSize;

        return $this->cells[(int)($x + ($y * $this->cellCountX))];
    }

    /**
     * Get the size of a single cell.
     *
     * @return integer
     */
    public function getCellSize(): int {
        return $this->cellSize;
    }

    /**
     * Get the width in units of the grid.
     *
     * @return integer
     */
    public function getGridWidth(): int {
        return $this->width;
    }

    /**
     * Get the height in units of the grid.
     *
     * @return integer
     */
    public function getGridHeight(): int {
        return $this->height;
    }

    /**
     * Get the cell count as a int.
     *
     * @return integer
     */
    public function getCellCount(): int {
        return $this->cellCountY * $this->cellCountX;
    }

}
