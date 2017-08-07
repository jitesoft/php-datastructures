<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector2DMath.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Point2D as Point;
use Jitesoft\Utilities\DataStructures\Math\Vector2D as Vector;

/**
 * Class Vector2DMath
 *
 * A Math helper class for vector structures.
 * Each vector does have the same method as these but they will change the actual vector calling rather than
 * create a new vector to return.
 */
class Vector2DMath {
    /**
     * Vector addition.
     *
     * @param Point $vector1
     * @param Point $vector2
     * @return Vector2D
     */
    public static function add(Point $vector1, Point $vector2) : Vector {
        return new Vector(
            $vector1->getX() + $vector2->getX(),
            $vector1->getY() + $vector2->getY()
        );
    }

    /**
     * Vector subtraction.
     *
     * @param Point $vector1
     * @param Point $vector2
     * @return Vector
     */
    public static function sub(Point $vector1, Point $vector2) : Vector {
        return new Vector(
            $vector1->getX() - $vector2->getX(),
            $vector1->getY() - $vector2->getY()
        );
    }

    /**
     * Vector multiplication.
     *
     * @param Vector $vector
     * @param Vector|Point|float $value
     * @return Vector
     */
    public static function mul(Vector $vector, $value) : Vector {
        $value = is_numeric($value) ? new Vector($value, $value) : $value;

        return new Vector(
            $vector->getX() * $value->getX(),
            $vector->getY() * $value->getY()
        );
    }

    /**
     * Vector division.
     *
     * @param Vector $vector
     * @param Vector|Point|float $value
     * @return Vector
     */
    public static function div(Vector $vector, $value) : Vector {
        $value = is_numeric($value) ? new Vector($value, $value) : $value;

        return new Vector(
            $vector->getX() / $value->getX(),
            $vector->getY() / $value->getY()
        );
    }

    /**
     * Dot product.
     *
     * @param Point $value1
     * @param Point $value2
     * @return float
     */
    public static function dot(Point $value1, Point $value2) : float {
        return
            $value1->getX() * $value2->getX()
            +
            $value1->getY() * $value2->getY();
    }

    /**
     * Get distance between two vectors/points.
     *
     * Use distance2 for a squared version with less of a performance hit.
     *
     * @param Point2D $value1
     * @param Point2D $value2
     * @return float
     */
    public static function distance(Point $value1, Point $value2) : float {
        return sqrt(self::distance2($value1, $value2));
    }

    /**
     * Get distance squared between two vectors/points.
     *
     * @param Point $value1
     * @param Point $value2
     * @return float
     */
    public static function distance2(Point $value1, Point $value2) : float {
        return
            ($value1->getX() - $value2->getX()) * ($value1->getX() - $value2->getX())
            +
            ($value1->getY() - $value2->getY()) * ($value1->getY() - $value2->getY());
    }

}
