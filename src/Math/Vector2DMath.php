<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector2DMath.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Point2D as Point;
use Jitesoft\Utilities\DataStructures\Math\Vector2D as Vector;

class Vector2DMath {
    /**
     * Vector addition.
     *
     * @param Point|Vector $vector1
     * @param Point|Vector $vector2
     * @return Vector2D
     */
    public static function add(Point $vector1, Point $vector2) : Vector {
        $result = new Vector($vector1->getX(), $vector1->getY());
        $result->add($vector2);
        return $result;
    }

    /**
     * Vector subtraction.
     *
     * @param Point|Vector $vector1
     * @param Point|Vector $vector2
     * @return Vector
     */
    public static function sub(Point $vector1, Point $vector2) : Vector {
        $result = new Vector($vector1->getX(), $vector1->getY());
        $result->sub($vector2);
        return $result;
    }

    /**
     * Vector multiplication.
     *
     * @param Vector|Point|float $vector1
     * @param Vector|Point|float $value
     * @return Vector
     */
    public static function mul(Point $vector1, $value) : Vector {
        $result = new Vector($vector1->getX(), $vector1->getY());
        $result->mul($value);
        return $result;
    }

    /**
     * Vector division.
     *
     * @param Vector|Point $vector1
     * @param Vector|Point|float $value
     * @return Vector
     */
    public static function div(Point $vector1, $value) : Vector {
        $result = new Vector($vector1->getX(), $vector1->getY());
        $result->div($value);
        return $result;
    }

    /**
     * Dot product.
     *
     * @param Vector $value1
     * @param Vector $value2
     * @return float
     */
    public static function dot(Vector $value1, Vector $value2) : float {
        return $value1->dot($value2);
    }
}
