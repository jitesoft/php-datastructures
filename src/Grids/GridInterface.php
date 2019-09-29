<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  GridInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Grids;

use Jitesoft\Utilities\Math\Vector2D;

/**
 * Interface GridInterface
 * Base interface for all grid types.
 */
interface GridInterface {

    /**
     * GridInterface constructor.
     *
     * @param integer $sizeX    Horizontal size in full units.
     * @param integer $sizeY    Vertical size in full units.
     * @param integer $cellSize Size of the cells in full units.
     */
    public function __construct(int $sizeX, int $sizeY, int $cellSize);

    /**
     * Insert a object into a cell or multiple cells.
     *
     * @param mixed    $object   Object to insert.
     * @param Vector2D $position Position to add object to.
     * @return boolean
     */
    public function addToCell($object, Vector2D $position) : bool;

    /**
     * Remove all items from all grid cells.
     *
     * @return boolean
     */
    public function clearGrid() : bool;

    /**
     * Get a single sell by position or index.
     *
     * @param integer|Vector2D $position Position either as a index or as a vector position.
     * @return GridCellInterface|null
     */
    public function getCell($position) : ?GridCellInterface;

    /**
     * Get the size of a single cell.
     *
     * @return integer
     */
    public function getCellSize() : int;

    /**
     * Get the width in units of the grid.
     *
     * @return integer
     */
    public function getGridWidth() : int;

    /**
     * Get the height in units of the grid.
     *
     * @return integer
     */
    public function getGridHeight() : int;

    /**
     * Get the cell count as a int.
     *
     * @return integer
     */
    public function getCellCount() : int;

}
