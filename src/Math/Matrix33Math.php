<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix33Math.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Exception;

/**
 * Class Matrix33Math
 *
 * A Math helper class for matrix33 structures.
 */
class Matrix33Math {

    /**
     * Matrix Matrix addition.
     *
     * @param Matrix33 $matrix
     * @param Matrix33 $matrix2
     * @return Matrix33
     */
    public static function add(Matrix33 $matrix, Matrix33 $matrix2) : Matrix33 {
        $result = new Matrix33();

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
    public static function sub(Matrix33 $matrix, Matrix33 $matrix2) : Matrix33 {
        $result = new Matrix33();

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
    public static function makeRotationX(float $angle, string $type = Math::DEGREES) : Matrix33 {
        if ($type === Math::DEGREES) {
            $angle = Math::degToRad($angle);
        }

        return new Matrix33(
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
    public static function makeRotationY(float $angle, string $type = Math::DEGREES) : Matrix33 {
        if ($type === Math::DEGREES) {
            $angle = Math::degToRad($angle);
        }

        return new Matrix33(
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
    public static function makeRotationZ(float $angle, string $type = Math::DEGREES) : Matrix33 {
        if ($type === Math::DEGREES) {
            $angle = Math::degToRad($angle);
        }

        return new Matrix33(
            cos($angle), - sin($angle), 0,
            sin($angle), cos($angle), 0,
            0, 0, 1
        );
    }
}
