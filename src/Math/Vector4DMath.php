<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector4DMath.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Vector4D as Vector;

class Vector4DMath {

    public static function mul(Vector $value1, $value2) : Vector {
        $value2 = is_numeric($value2) ? new Vector($value2,$value2,$value2,$value2) : $value2;

        return new Vector(
            $value1->getX() * $value2->getX(),
            $value1->getY() * $value2->getY(),
            $value1->getZ() * $value2->getZ(),
            $value1->getW() * $value2->getW()
        );
    }

    public static function div(Vector $value1, $value2) : Vector {
        $value2 = is_numeric($value2) ? new Vector($value2,$value2,$value2,$value2) : $value2;

        return new Vector(
            $value1->getX() / $value2->getX(),
            $value1->getY() / $value2->getY(),
            $value1->getZ() / $value2->getZ(),
            $value1->getW() / $value2->getW()
        );
    }

    public static function add(Vector $value1, Vector $value2) : Vector {
        return new Vector(
            $value1->getX() + $value2->getX(),
            $value1->getY() + $value2->getY(),
            $value1->getZ() + $value2->getZ(),
            $value1->getW() + $value2->getW()
        );
    }

    public static function sub(Vector $value1, Vector $value2) : Vector {
        return new Vector(
            $value1->getX() - $value2->getX(),
            $value1->getY() - $value2->getY(),
            $value1->getZ() - $value2->getZ(),
            $value1->getW() - $value2->getW()
        );
    }

    public static function cross(Vector $value1, Vector $value2) : float {}
    public static function dot(Vector $value1, Vector $value2) : float {}
    public static function distance(Vector $value1, Vector $value2) : float {}
    public static function distance2(Vector $value1, Vector $value2) : float {}

}
