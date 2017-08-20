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
        $sign = 1;
        // Go through each element in first row.
        for ($counter=0;$counter<$rcCount;$counter++) {
            // Create a cofactor sub-matrix ($rcCount-1 in size).
            $subMatrix = self::getCofactor($matrix, 0, $counter);
            // Calculate the determinant of the sub-matrix.
            $determinant += $sign * $matrix[0][$counter] * self::calculateDeterminant($subMatrix);
            $sign         = -$sign;
        }

        return $determinant;
    }

}
