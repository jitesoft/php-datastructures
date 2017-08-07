<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Point3D.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Math;

/**
 * Class Point3D
 *
 * A point in a three dimensional space.
 */
class Point3D extends Point2D {

    /** @var float */
    protected $z;

    /**
     * Initialize a point object.
     *
     * Point3D constructor.
     * @param float $x
     * @param float $y
     * @param float $z
     */
    public function __construct(float $x = 0, float $y = 0, float $z = 0) {
        parent::__construct($x, $y);

        $this->z = $z;
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
}
