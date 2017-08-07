<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector3D.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Point3D as Point;
use Jitesoft\Utilities\DataStructures\Math\Vector3DMath as _;

/**
 * Class Vector3D
 *
 * Vector structure in 3D space.
 */
class Vector3D extends Point3D {


    /**
     * Make the given vector a copy of another vector.
     * Basically assigns X and Y of the vector to the X and Y of passed point/vector.
     *
     * @param Point $copy
     */
    private function copy(Point $copy) {
        $this->x = $copy->x;
        $this->y = $copy->y;
        $this->z = $copy->z;
    }

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
        parent::__construct($x, $y, $z);
    }





}
