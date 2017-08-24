<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector2D.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

/**
 * Class Vector2D
 *
 * Vector structure in 2D space.
 *
 * A vector consists of two floating point numbers and can be accessed through
 * either their get-accessors (getX, getY) or through array access.
 * (x/X/0, y/Y/1).
 */
class Vector2D extends Vector {

    public const ELEMENT_COUNT = 2;

    /** @var float */
    protected $x;
    /** @var float */
    protected $y;

    /** @var array */
    protected const OFFSETS = [
        'x' => 'x', 'X' => 'x', 0 => 'x',
        'y' => 'y', 'Y' => 'y', 1 => 'y',
    ];

    /**
     * Create a Vector2D instance.
     *
     * Vector2D constructor.
     *
     * @param float $x Initial X-Coordinate.
     * @param float $y Initial Y-Coordinate.
     */
    public function __construct(float $x = 0, float $y = 0) {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Set the X and Y coordinate of the vector.
     *
     * @param float $x X-Coordinate.
     * @param float $y Y-Coordinate.
     */
    public function set(float $x, float $y) {
        $this->setX($x);
        $this->setY($y);
    }

    /**
     * Get the X-Coordinate.
     *
     * @return float
     */
    public function getX(): float {
        return $this->x;
    }

    /**
     * Set the X-Coordinate.
     *
     * @param float $x
     */
    public function setX(float $x) {
        $this->x = $x;
    }

    /**
     * Get the Y-Coordinate.
     *
     * @return float
     */
    public function getY(): float {
        return $this->y;
    }

    /**
     * Set the Y-Coordinate.
     *
     * @param float $y
     */
    public function setY(float $y) {
        $this->y = $y;
    }

}
