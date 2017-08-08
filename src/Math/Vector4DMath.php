<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector4DMath.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Vector4D as Vector;

class Vector4DMath {

    /**
     * Vector multiplication.
     *
     * @param Vector4D $value1
     * @param $value2
     * @return Vector4D
     */
    public static function mul(Vector $value1, $value2) : Vector {
        $value2 = is_numeric($value2) ? new Vector($value2,$value2,$value2,$value2) : $value2;

        return new Vector(
            $value1->getX() * $value2->getX(),
            $value1->getY() * $value2->getY(),
            $value1->getZ() * $value2->getZ(),
            $value1->getW() * $value2->getW()
        );
    }

    /**
     * Vector division.
     *
     * @param Vector4D $value1
     * @param $value2
     * @return Vector4D
     */
    public static function div(Vector $value1, $value2) : Vector {
        $value2 = is_numeric($value2) ? new Vector($value2,$value2,$value2,$value2) : $value2;

        return new Vector(
            $value1->getX() / $value2->getX(),
            $value1->getY() / $value2->getY(),
            $value1->getZ() / $value2->getZ(),
            $value1->getW() / $value2->getW()
        );
    }

    /**
     * Vector addition.
     *
     * @param Vector4D $value1
     * @param Vector4D $value2
     * @return Vector4D
     */
    public static function add(Vector $value1, Vector $value2) : Vector {
        return new Vector(
            $value1->getX() + $value2->getX(),
            $value1->getY() + $value2->getY(),
            $value1->getZ() + $value2->getZ(),
            $value1->getW() + $value2->getW()
        );
    }

    /**
     * Vector subtraction.
     *
     * @param Vector4D $value1
     * @param Vector4D $value2
     * @return Vector4D
     */
    public static function sub(Vector $value1, Vector $value2) : Vector {
        return new Vector(
            $value1->getX() - $value2->getX(),
            $value1->getY() - $value2->getY(),
            $value1->getZ() - $value2->getZ(),
            $value1->getW() - $value2->getW()
        );
    }

    /**
     * Calculate dot-product of two vectors.
     *
     * @param Vector4D $value1
     * @param Vector4D $value2
     * @return float
     */
    public static function dot(Vector $value1, Vector $value2) : float {
        return
            ($value1->getX() * $value2->getX())
            +
            ($value1->getY() * $value2->getY())
            +
            ($value1->getZ() * $value2->getZ())
            +
            ($value1->getW() * $value2->getW());
    }

    /**
     * Calculate distance between two vectors.
     *
     * @param Vector4D $value1
     * @param Vector4D $value2
     * @return float
     */
    public static function distance(Vector $value1, Vector $value2) : float {
        return sqrt(self::distance2($value1, $value2));
    }

    /**
     * Calculate squared distance between two vectors.
     *
     * @param Vector4D $value1
     * @param Vector4D $value2
     * @return float
     */
    public static function distance2(Vector $value1, Vector $value2) : float {
        return
            ($value1->getX() - $value2->getX()) * ($value1->getX() - $value2->getX())
            +
            ($value1->getY() - $value2->getY()) * ($value1->getY() - $value2->getY())
            +
            ($value1->getZ() - $value2->getZ()) * ($value1->getZ() - $value2->getZ())
            +
            ($value1->getW() - $value2->getW()) * ($value1->getW() - $value2->getW());
    }

}
