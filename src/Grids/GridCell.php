<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  GridCell.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Grids;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Exceptions\Logic\OutOfBoundsException;
use Jitesoft\Utilities\DataStructures\Lists\IndexedList;
use Jitesoft\Utilities\DataStructures\Lists\IndexedListInterface;
use Jitesoft\Utilities\Math\Vector2D;
use Jitesoft\Utilities\Math\VectorMath;

/**
 * Class GridCell
 *
 * Grid cell implementation.
 */
class GridCell implements GridCellInterface {

    /** @var IndexedListInterface */
    private $objects;
    /** @var integer */
    protected $indexX;
    /** @var integer */
    protected $indexY;
    /** @var integer */
    protected $cellSize;
    /** @var Vector2D */
    protected $center;
    /** @var float */
    protected $radius;

    /**
     * GridCellInterface constructor.
     *
     * @param integer  $indexX   Maximum X.
     * @param integer  $indexY   Maximum Y.
     * @param integer  $cellSize Size of each cell.
     * @param Vector2D $center   Center cell.
     */
    public function __construct(int $indexX,
                                int $indexY,
                                int $cellSize,
                                Vector2D $center) {
        $this->objects    = new IndexedList();
        $this->cellSize   = $cellSize;
        $this->indexX     = $indexX;
        $this->indexY     = $indexY;
        $this->center     = $center;
        $upperRightCorner = VectorMath::sub($this->center, ($cellSize * 0.5));
        $centToCorn       = VectorMath::sub($upperRightCorner, $this->center);
        $this->radius     = $centToCorn->length();
    }

    /**
     * Get the cells X index in its grid.
     *
     * @return integer
     */
    public function getIndexX(): int {
        return $this->indexX;
    }

    /**
     * Get the sells Y index in its grid.
     *
     * @return integer
     */
    public function getIndexY(): int {
        return $this->indexY;
    }

    /**
     * Get all objects in the cell as a ListInterface.
     *
     * @return IndexedListInterface
     */
    public function getObjects(): IndexedListInterface {
        return $this->objects;
    }

    /**
     * Get the position of the cell in units as a Vector2D.
     *
     * @return Vector2D
     */
    public function getPosition(): Vector2D {
        return $this->center;
    }

    /**
     * Add a object to the cell.
     *
     * @param mixed $object Object to add.
     * @return boolean
     */
    public function add($object): bool {
        return $this->objects->add($object);
    }

    /**
     * Insert a object into the cell at a given index.
     *
     * @param mixed   $object Object to insert.
     * @param integer $index  Index to insert object at.
     * @return boolean
     * @throws InvalidArgumentException Deprecated.
     * @throws OutOfBoundsException     On out of bounds error.
     */
    public function insert($object, int $index): bool {
        return $this->objects->insert($object, $index);
    }

    /**
     * Remove a object from the cell.
     *
     * @param mixed $object Object to remove.
     * @return boolean
     */
    public function remove($object): bool {
        return $this->objects->remove($object);
    }

    /**
     * Remove a object from the cell at a given index.
     *
     * @param integer $index Index to remove.
     * @return boolean
     * @throws InvalidArgumentException Deprecated.
     * @throws OutOfBoundsException     On out of bounds error.
     */
    public function removeAt(int $index): bool {
        return $this->objects->removeAt($index);
    }

    /**
     * Clear all the objects in the cell.
     *
     * @return boolean
     */
    public function clear(): bool {
        return $this->objects->clear();
    }

    /**
     * Get the radius of the cell as a float.
     *
     * @return float
     */
    public function getRadius(): float {
        return $this->radius;
    }

    /**
     * Get the center of the cell as a Vector2D.
     *
     * @return Vector2D
     */
    public function getCenter(): Vector2D {
        return $this->center;
    }

}
