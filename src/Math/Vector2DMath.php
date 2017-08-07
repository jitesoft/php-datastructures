<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector2DMath.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Point2D as Point;

class Vector2DMath {



    /**
     * Vector addition.
     *
     * @param Point|Vector2D $vector1
     * @param Point|Vector2D $vector2
     * @return Vector2D
     */
    public static function add(Point $vector1, Point $vector2) : Vector2D {
        $result = new Vector2D($vector1->getX(), $vector1->getY());
        $result->add($vector2);
        return $result;
    }

    /**
     * Vector subtraction.
     *
     * @param Point|Vector2D $vector1
     * @param Point|Vector2D $vector2
     * @return Vector2D
     */
    public static function sub(Point $vector1, Point $vector2) : Vector2D {}

    /**
     * Vector multiplication.
     *
     * @param Vector2D|Point|float $vector1
     * @param Vector2D|Point|float $value
     * @return Vector2D
     */
    public static function mul(Point $vector1, $value) : Vector2D {}

    /**
     * Vector division.
     *
     * @param Vector2D|Point $vector1
     * @param Vector2D|Point|float $value
     * @return Vector2D
     */
    public static function div(Point $vector1, $value) : Vector2D {}

    /**
     * Dot product.
     *
     * @param Point2D $value1
     * @param Point2D $value2
     * @return float
     */
    public static function dot(Point $value1, Point $value2) : float {}



    /**
     * Vector multiplication with a float value.
     *
     * @param Vector2D|Point $vector
     * @param float $float
     * @return Vector2D
     */
    private static function mul_f(Point $vector, float $float) : Vector2D {}

    /**
     * Vector division with a float value.
     *
     * @param Vector2D|Point $vector
     * @param float $float
     * @return Vector2D
     */
    private static function div_f(Point $vector, float $float) : Vector2D {}


}
