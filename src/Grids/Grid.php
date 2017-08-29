<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Grid.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Grids;

use Jitesoft\Utilities\DataStructures\Contracts\GridCellInterface;
use Jitesoft\Utilities\DataStructures\Contracts\GridInterface;
use Jitesoft\Utilities\DataStructures\Contracts\ListInterface;
use Jitesoft\Utilities\DataStructures\Lists\IndexedList;
use Jitesoft\Utilities\Math\Vector2D;

class Grid implements GridInterface {

    /** @var int */
    protected $width;
    /** @var int */
    protected $height;
    /** @var int */
    protected $cellSize;
    /** @var int */
    protected $cellCountX;
    /** @var int */
    protected $cellCountY;
    /** @var ListInterface|GridCell[] */
    protected $cells;

    /**
     * {@inheritDoc}
     */
    public function __construct(int $sizeX, int $sizeY, int $cellSize) {
        $this->width    = $sizeX;
        $this->height   = $sizeY;
        $this->cellSize = $cellSize;

        $this->cellCountX = (int)($sizeX / $cellSize);
        $this->cellCountY = (int)($sizeY / $cellSize);

        $this->cells = new IndexedList();

        $startPoint = new Vector2D(0, 0); // Upper right.

        for ($x=0;$x<$this->cellCountX;$x++) {
            for ($y=0;$y<$this->cellCountY;$y++) {
                $this->cells->add(new GridCell($x, $y, $cellSize, $startPoint));
                $startPoint['x'] += $cellSize;
            }
            $startPoint['x']  = 0;
            $startPoint['y'] += $cellSize;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addToCell($object, Vector2D $position): bool {
        return $this->getCell($position)->add($object);
    }

    /**
     * {@inheritDoc}
     */
    public function clearGrid(): bool {
        $result = true;
        for ($i=$this->cells->length();$i-->0;) {
            $result = ($result === false ? false : $this->cells[$i]->clear());
        }
        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function getCell($position): ?GridCellInterface {
        if (is_int($position)) {
            return $this->cells[$position];
        }

        $x = (int)$position['x'] / $this->cellSize;
        $y = (int)$position['y'] / $this->cellSize;

        return $this->cells[(int)($x + ($y*$this->cellCountX))];
    }

    /**
     * {@inheritDoc}
     */
    public function getCellSize(): int {
        return $this->cellSize;
    }

    /**
     * {@inheritDoc}
     */
    public function getGridWidth(): int {
        return $this->width;
    }

    /**
     * {@inheritDoc}
     */
    public function getGridHeight(): int {
        return $this->height;
    }

    /**
     * {@inheritDoc}
     */
    public function getCellCount(): int {
        return $this->cellCountY * $this->cellCountX;
    }
}
