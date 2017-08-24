<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector3D.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\VectorMath;

/**
 * Class Vector3D
 *
 * Vector structure in 3D space.
 *
 * A vector consists of three floating point numbers and can be accessed through
 * either their get-accessors (getX, getY, getZ) or through array access.
 * (x/X/0, y/Y/1, z/Z/2).
 */
class Vector3D extends Vector {

    public const ELEMENT_COUNT = 3;

    /** @var array */
    protected const OFFSETS = [
        'x' => 'x', 'X' => 'x', 0 => 'x',
        'y' => 'y', 'Y' => 'y', 1 => 'y',
        'z' => 'z', 'Z' => 'z', 2 => 'z'
    ];

    /** @var float */
    protected $x;
    /** @var float */
    protected $y;
    /** @var float */
    protected $z;

    /**
     * Create a Vector3D.
     *
     * Vector3D constructor.
     *
     * @param float $x
     * @param float $y
     * @param float $z
     */
    public function __construct(float $x = 0, float $y = 0, float $z = 0) {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * Calculates the cross product of two vectors.
     *
     * @param Vector3D $vector
     */
    public function cross(Vector3D $vector) {
        $this->copy(VectorMath::cross($this, $vector));
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
     * Get the Z-Coordinate.
     *
     * @return float
     */
    public function getZ() : float {
        return $this->z;
    }

    /**
     * Set the X-Coordinate of the point.
     *
     * @param float $x
     */
    public function setX(float $x) {
        $this->x = $x;
    }

    /**
     * Set the Y-Coordinate of the point.
     * @param float $y
     */
    public function setY(float $y) {
        $this->y = $y;
    }

    /**
     * Get the X-Coordinate of the point.
     *
     * @return float
     */
    public function getX() : float {
        return $this->x;
    }

    /**
     * Get tye Y-Coordinate of the point.
     *
     * @return float
     */
    public function getY() : float {
        return $this->y;
    }

}
