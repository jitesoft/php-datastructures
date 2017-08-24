<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector4D.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

/**
 * Class Vector4D
 *
 * A vector structure in four dimensional space.
 *
 *
 * A vector consists of four floating point numbers and can be accessed through
 * either their get-accessors (getX, getY, getZ, getW) or through array access.
 * (x/X/0, y/Y/1, z/Z/2, w/W/3).
 */
class Vector4D extends Vector {

    public const ELEMENT_COUNT = 4;

    /** @var array */
    protected const OFFSETS = [
        'X' => 'x', 0 => 'x',
        'Y' => 'y', 1 => 'y',
        'Z' => 'z', 2 => 'z',
        'W' => 'w', 3 => 'w'
    ];

    /** @var float */
    protected $x;
    /** @var float */
    protected $y;
    /** @var float */
    protected $z;
    /** @var float */
    protected $w;

    /**
     * Create a 4 dimensional vector.
     *
     * Vector4D constructor.
     * @param float $x
     * @param float $y
     * @param float $z
     * @param float $w
     */
    public function __construct(float $x = 0, float $y = 0, float $z = 0, float $w = 0) {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->w = $w;
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

    /**
     * Get the Z-Coordinate.
     *
     * @return float
     */
    public function getZ(): float {
        return $this->z;
    }

    /**
     * Set the Z-Coordinate.
     *
     * @param float $z
     */
    public function setZ(float $z) {
        $this->z = $z;
    }

    /**
     * Get the W-Coordinate.
     *
     * @return float
     */
    public function getW(): float {
        return $this->w;
    }

    /**
     * Set the W-Coordinate.
     *
     * @param float $w
     */
    public function setW(float $w) {
        $this->w = $w;
    }
}
