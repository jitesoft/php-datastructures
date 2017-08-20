<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix44Math.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

class Matrix44Math {

    /**
     * Get identity matrix.
     *
     * @return Matrix
     */
    public static function identity() : Matrix {
        return new Matrix44(
            1, 0, 0, 0,
            0, 1, 0, 0,
            0, 0, 1, 0,
            0, 0, 0, 1
        );
    }

    public static function mul(Matrix $matrix, $value) : Matrix {

    }

    public static function add(Matrix $matrix, Matrix $matrix2) : Matrix {

    }

    public static function sub(Matrix $matrix, Matrix $matrix2) : Matrix {

    }

    public static function makeRotationX(float $angle, string $type = Math::DEGREES) : Matrix {

    }

    public static function makeRotationY(float $angle, string $type = Math::DEGREES) : Matrix {

    }

    public static function makeRotationZ(float $angle, string $type = Math::DEGREES) : Matrix {

    }
}
