<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  MatrixMath.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Exception;

/**
 * Class MatrixMath
 *
 * Math helper class for all matrix implementations.
 */
class MatrixMath {

    public static function identity($type = Matrix44::class) : Matrix {
        $matrix = new $type();

        for ($i=0;$i<$type::ROWS;$i++) {
            for ($j=0;$j<$type::COLUMNS;$j++) {
                $matrix[$i][$j] = $i === $j ? 1 : 0;
            }
        }
        return $matrix;
    }

    /**
     * @param float[][] $matrix
     * @param int $skipRow
     * @param int $skipColumn
     * @return array
     */
    public static function getCofactor($matrix, $skipRow = 0, $skipColumn = 0) : array {
        $size     = count($matrix);
        $newSize  = $size-1;
        $cfRow    = 0;
        $cfColumn = 0;
        $cfMatrix = [];

        for ($row=0;$row<$size;$row++) {
            for ($col=0;$col<$size;$col++) {

                if ($row !== $skipRow && $col !== $skipColumn) {
                    if (!isset($cfMatrix[$cfRow])) {
                        $cfMatrix[$cfRow] = [];
                    }
                    $cfMatrix[$cfRow][$cfColumn++] = $matrix[$row][$col];
                    if ($cfColumn === ($newSize)) {
                        $cfColumn = 0;
                        $cfRow++;
                    }
                }
            }
        }
        return $cfMatrix;
    }

    /**
     * @param float[][] $matrix
     * @return float
     * @throws Exception
     */
    public static function calculateDeterminant($matrix) : float {
        // The ´rows´ args is the only needed one. Determinants can only be calculated
        // from a square matrix. Hence we use the row as size for both row and column.
        $determinant = 0;
        $rcCount     = count($matrix);
        if ($rcCount !== count($matrix[0])) {
            throw new Exception(
                "Can only calculate determinant from square matrix (same amount of rows as columns)."
            );
        }

        // If only one element, return the value from it.
        if ($rcCount === 1) {
            return $matrix[0][0];
        }

        // Go through each element in first row.
        for ($counter=0;$counter<$rcCount;$counter++) {
            // Create a cofactor sub-matrix ($rcCount-1 in size).
            $subMatrix = self::getCofactor($matrix, 0, $counter);
            // Calculate the determinant of the sub-matrix.
            $sign         = Matrix::SIGN_CHART[0][$counter];
            $determinant += $sign * $matrix[0][$counter] * self::calculateDeterminant($subMatrix);
        }

        return $determinant;
    }


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
        $type   = get_class($matrix);
        $result = new $type();

        for ($x=0;$x<$type::ROWS;$x++) {
            for ($y=0;$y<$type::ROWS;$y++) {
                $value = 0;
                for ($z=0;$z<$type::COLUMNS;$z++) {
                    $value += $matrix[$y][$z] * $matrix2[$z][$x];
                }
                $result[$y][$x] = $value;
            }
        }

        return $result;
    }

    private static function mulFloat(Matrix $matrix, float $value) : Matrix {
        $type   = get_class($matrix);
        $result = new $type();

        for ($i=0;$i<$type::ROWS;$i++) {
            for ($j=0;$j<$type::COLUMNS;$j++) {
                $result[$i][$j] = $matrix[$i][$j] * $value;
            }
        }

        return $result;
    }
}
