<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector3DMath.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Vector3D as Vector;
use Jitesoft\Utilities\DataStructures\Math\Point3D as Point;

/**
 * Class Vector3DMath
 *
 * A Math helper class for vector structures.
 * Each vector does have the same method as these but they will change the actual vector calling rather than
 * create a new vector to return.
 */
class Vector3DMath {

    /**
     * Vector multiplication.
     *
     * @param Point $value1
     * @param Point|float $value2
     * @return Vector
     */
    public static function mul(Point $value1, $value2) : Vector {
        $value2 = is_numeric($value2) ? new Vector($value2, $value2, $value2) : $value2;

        return new Vector(
            $value1->getX() * $value2->getX(),
            $value1->getY() * $value2->getY(),
            $value1->getZ() * $value2->getZ()
        );
    }

    /**
     * Vector division.
     *
     * @param Point $value1
     * @param Point|float $value2
     * @return Vector
     */
    public static function div(Point $value1, $value2) : Vector {
        $value2 = is_numeric($value2) ? new Vector($value2, $value2, $value2) : $value2;

        return new Vector(
            $value1->getX() / $value2->getX(),
            $value1->getY() / $value2->getY(),
            $value1->getZ() / $value2->getZ()
        );
    }

    /**
     * Vector addition.
     *
     * @param Point $value1
     * @param Point $value2
     * @return Vector
     */
    public static function add(Point $value1, Point $value2) : Vector {
        return new Vector(
            $value1->getX() + $value2->getX(),
            $value1->getY() + $value2->getY(),
            $value1->getZ() + $value2->getZ()
        );
    }

    /**
     * Vector subtraction.
     *
     * @param Point $value1
     * @param Point|float $value2
     * @return Vector
     */
    public static function sub(Point $value1, Point $value2) : Vector {
        return new Vector(
            $value1->getX() - $value2->getX(),
            $value1->getY() - $value2->getY(),
            $value1->getZ() - $value2->getZ()
        );
    }

    /**
     * Dot product of two vectors/points.
     *
     * @param Point $value1
     * @param Point $value2
     * @return float
     */
    public static function dot(Point $value1, Point $value2) : float {

    }

    /**
     * Cross product of two vectors/points.
     *
     * @param Point $value1
     * @param Point $value2
     * @return Vector
     */
    public static function cross(Point $value1, Point $value2) : Vector {

    }

    /**
     * Distance between two vectors/points.
     *
     * @param Point $value1
     * @param Point $value2
     * @return float
     */
    public static function distance(Point $value1, Point $value2) : float {

    }

    /**
     * Squared distance between two vectors/points.
     *
     * @param Point $value1
     * @param Point $value2
     * @return float
     */
    public static function distance2(Point $value1, Point $value2) : float {

    }
}
