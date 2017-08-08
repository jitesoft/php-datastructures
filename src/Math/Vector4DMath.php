<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector4DMath.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Vector4D as Vector;

class Vector4DMath {

    public static function mul(Vector $value1, $value2) : Vector {}
    public static function div(Vector $value1, $value2) : Vector {}
    public static function add(Vector $value1, Vector $value2) : Vector {}
    public static function sub(Vector $value1, Vector $value2) : Vector {}

    public static function cross(Vector $value1, Vector $value2) : float {}
    public static function dot(Vector $value1, Vector $value2) : float {}
    public static function distance(Vector $value1, Vector $value2) : float {}
    public static function distance2(Vector $value1, Vector $value2) : float {}

}
