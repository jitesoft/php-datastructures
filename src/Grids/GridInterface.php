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
     * @param int $sizeX Horizontal size in full units.
     * @param int $sizeY Vertical size in full units.
     * @param int $cellSize Size of the cells in full units.
     */
    public function __construct(int $sizeX, int $sizeY, int $cellSize);

    /**
     * Insert a object into a cell or multiple cells.
     *
     * @param mixed $object Object to insert.
     * @param Vector2D $position
     * @return bool
     */
    public function addToCell($object, Vector2D $position) : bool;

    /**
     * Remove all items from all grid cells.
     *
     * @return bool
     */
    public function clearGrid() : bool;

    /**
     * Get a single sell by position or index.
     *
     * @param int|Vector2D $position Position either as a index or as a vector position.
     * @return GridCellInterface|null
     */
    public function getCell($position) : ?GridCellInterface;

    /**
     * Get the size of a single cell.
     *
     * @return int
     */
    public function getCellSize() : int;

    /**
     * Get the width in units of the grid.
     *
     * @return int
     */
    public function getGridWidth() : int;

    /**
     * Get the height in units of the grid.
     *
     * @return int
     */
    public function getGridHeight() : int;

    /**
     * Get the cell count as a int.
     *
     * @return int
     */
    public function getCellCount() : int;
}
