<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  GridInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Contracts;

use Jitesoft\Utilities\Math\Vector2D;

/**
 * Interface GridInterface
 * Base interface for all grid types.
 */
interface GridInterface {

    /**
     * GridInterface constructor.
     *
     * @param int $sizeX Number of horizontal cells.
     * @param int $sizeY Number of vertical cells.
     * @param int $cellSize Size of the cells.
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
     * Get the size in units of the grid as a Vector2D.
     *
     * @return Vector2D
     */
    public function getGridSize() : Vector2D;

    /**
     * Get the cell count as a Vector2D.
     *
     * @return Vector2D
     */
    public function getCellCount() : Vector2D;
}
