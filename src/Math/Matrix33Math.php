<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix33Math.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Exception;
use Jitesoft\Utilities\DataStructures\Math\Matrix33 as Matrix;

/**
 * Class Matrix33Math
 *
 * A Math helper class for matrix33 structures.
 */
class Matrix33Math {

    /**
     * Create a identity matrix.
     *
     * [1,0,0]
     * [0,1,0]
     * [0,0,1]
     *
     * @return Matrix33
     */
    public static function identity() : Matrix {

        return new Matrix(
            1, 0, 0,
            0, 1, 0,
            0, 0, 1
        );
    }

    /**
     * Matrix multiplication.
     *
     * @param Matrix33 $matrix
     * @param float|Matrix33 $value Scalar or matrix to multiply the matrix with.
     * @return Matrix33
     * @throws Exception On invalid value type.
     */
    public static function mul(Matrix $matrix, $value) : Matrix {

        if ($value instanceof Matrix) {
            return self::mulMatrix($matrix, $value);
        }

        if (is_numeric($value)) {
            return self::mulFloat($matrix, $value);
        }

        $type = gettype($value);
        throw new Exception("Invalid type. Can not multiply a matrix with {$type}.");
    }

    private static function mulMatrix(Matrix $matrix, Matrix $matrix2) : Matrix {
        $result = new Matrix();

        for ($x=0;$x<3;$x++) {
            for ($y=0;$y<3;$y++) {
                $value = 0;
                for ($z=0;$z<3;$z++) {
                    $value += $matrix[$y][$z] * $matrix2[$z][$x];
                }
                $result[$y][$x] = $value;
            }
        }

        return $result;
    }

    private static function mulFloat(Matrix $matrix, float $value) : Matrix {
        $result = new Matrix();

        for ($i=0;$i<3;$i++) {
            for ($j=0;$j<3;$j++) {
                $result[$i][$j] = $matrix[$i][$j] * $value;
            }
        }

        return $result;
    }

    /**
     * Matrix Matrix addition.
     *
     * @param Matrix33 $matrix
     * @param Matrix33 $matrix2
     * @return Matrix33
     */
    public static function add(Matrix $matrix, Matrix $matrix2) : Matrix {
        $result = new Matrix();

        for ($i=0;$i<3;$i++) {
            for ($j=0;$j<3;$j++) {
                $result[$i][$j] = $matrix[$i][$j] + $matrix2[$i][$j];
            }
        }

        return $result;
    }

    /**
     * Matrix Matrix subtraction.
     *
     * @param Matrix33 $matrix
     * @param Matrix33 $matrix2
     * @return Matrix33
     */
    public static function sub(Matrix $matrix, Matrix $matrix2) : Matrix {
        $result = new Matrix();

        for ($i=0;$i<3;$i++) {
            for ($j=0;$j<3;$j++) {
                $result[$i][$j] = $matrix[$i][$j] - $matrix2[$i][$j];
            }
        }

        return $result;
    }

    /**
     * Create a rotation matrix with given X angle rotation.
     *
     * @param float $angle
     * @param string $type If degrees or radians, see Math constants.
     * @return Matrix33
     */
    public static function makeRotationX(float $angle, string $type = Math::DEGREES) : Matrix {
        if ($type === Math::DEGREES) {
            $angle = Math::degToRad($angle);
        }

        return new Matrix(
            1, 0, 0,
            0, cos($angle), - sin($angle),
            0, sin($angle), cos($angle)
        );
    }

    /**
     * Create a rotation matrix with given Y angle rotation.
     *
     * @param float $angle
     * @param string $type If degrees or radians, see Math constants.
     * @return Matrix33
     */
    public static function makeRotationY(float $angle, string $type = Math::DEGREES) : Matrix {
        if ($type === Math::DEGREES) {
            $angle = Math::degToRad($angle);
        }

        return new Matrix(
            cos($angle), 0, sin($angle),
            0, 1, 0,
            - sin($angle), 0, cos($angle)
        );
    }

    /**
     * Create a rotation matrix with given Z angle rotation.
     *
     * @param float $angle
     * @param string $type If degrees or radians, see Math constants.
     * @return Matrix33
     */
    public static function makeRotationZ(float $angle, string $type = Math::DEGREES) : Matrix {
        if ($type === Math::DEGREES) {
            $angle = Math::degToRad($angle);
        }

        return new Matrix(
            cos($angle), - sin($angle), 0,
            sin($angle), cos($angle), 0,
            0, 0, 1
        );
    }
}
