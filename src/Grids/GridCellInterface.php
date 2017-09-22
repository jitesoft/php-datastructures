<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  GridCellInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Grids;

use Jitesoft\Utilities\DataStructures\Lists\IndexedListInterface;
use Jitesoft\Utilities\Math\Vector2D;

/**
 * Interface for grid cell implementations.
 */
interface GridCellInterface {

    /**
     * GridCellInterface constructor.
     *
     * @param int $indexX
     * @param int $indexY
     * @param int $cellSize
     * @param Vector2D $center
     */
    public function __construct(int $indexX, int $indexY, int $cellSize, Vector2D $center);

    /**
     * Get the cells X index in its grid.
     *
     * @return int
     */
    public function getIndexX() : int;

    /**
     * Get the sells Y index in its grid.
     *
     * @return int
     */
    public function getIndexY() : int;

    /**
     * Get all objects in the cell as a IndexedListInterface.
     *
     * @return IndexedListInterface
     */
    public function getObjects() : IndexedListInterface;

    /**
     * Get the position of the cell in units as a Vector2D.
     *
     * @return Vector2D
     */
    public function getPosition() : Vector2D;

    /**
     * Add a object to the cell.
     *
     * @param $object
     * @return bool
     */
    public function add($object) : bool;

    /**
     * Insert a object into the cell at a given index.
     *
     * @param $object
     * @param int $index
     * @return bool
     */
    public function insert($object, int $index) : bool;

    /**
     * Remove a object from the cell.
     *
     * @param $object
     * @return bool
     */
    public function remove($object) : bool;

    /**
     * Remove a object from the cell at a given index.
     *
     * @param $index
     * @return bool
     */
    public function removeAt($index) : bool;

    /**
     * Clear all the objects in the cell.
     *
     * @return bool
     */
    public function clear() : bool;

    /**
     * Get the radius of the cell as a float.
     *
     * @return float
     */
    public function getRadius() : float;

    /**
     * Get the center of the cell as a Vector2D.
     *
     * @return Vector2D
     */
    public function getCenter() : Vector2D;
}
