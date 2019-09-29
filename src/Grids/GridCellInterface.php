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
     * @param integer  $indexX   Maximum X.
     * @param integer  $indexY   Maximum Y.
     * @param integer  $cellSize Size of each cell.
     * @param Vector2D $center   Center cell.
     */
    public function __construct(
        int $indexX,
        int $indexY,
        int $cellSize,
        Vector2D $center
    );

    /**
     * Get the cells X index in its grid.
     *
     * @return integer
     */
    public function getIndexX() : int;

    /**
     * Get the sells Y index in its grid.
     *
     * @return integer
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
     * @param mixed $object Object to insert.
     * @return boolean
     */
    public function add($object) : bool;

    /**
     * Insert a object into the cell at a given index.
     *
     * @param mixed   $object Object to insert.
     * @param integer $index  Index to insert object at.
     * @return boolean
     */
    public function insert($object, int $index) : bool;

    /**
     * Remove a object from the cell.
     *
     * @param mixed $object Object to remove.
     * @return boolean
     */
    public function remove($object) : bool;

    /**
     * Remove a object from the cell at a given index.
     *
     * @param integer $index Index to remove.
     * @return boolean
     */
    public function removeAt(int $index) : bool;

    /**
     * Clear all the objects in the cell.
     *
     * @return boolean
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
