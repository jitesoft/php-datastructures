<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use ArrayAccess;
use Exception;

/**
 * Class Matrix
 *
 * The base class used by all matrix classes.
 */
abstract class Matrix implements ArrayAccess {

    /** @var int[][] */
    protected static $cofactors = [
        [1, -1, 1, -1],
        [-1, 1, -1, 1],
        [1, -1, 1, -1],
        [-1, 1, -1, 1]
    ];

    /** @var int  */
    protected $rows = 0;
    /** @var int */
    protected $columns = 0;
    /** @var Vector3D[] */
    protected $vectors = [];

    /**
     * Calculate the matrix determinant.
     *
     * @return float
     */
    public abstract function determinant() : float;

    /**
     * Get the minors matrix of the matrix.
     *
     * @return Matrix
     */
    public abstract function getMinors() : Matrix;

    /**
     * Transpose the matrix.
     */
    public abstract function transpose();

    /**
     * Inverse the matrix.
     */
    public function inverse() {
        $determinant = $this->determinant();
        if ($determinant === 0) { // If 0, there is no inverse.
            return;
        }

        $minors = $this->getMinors();
        for ($i=0;$i<$this->rows;$i++) {
            for ($j=0;$j<$this->columns;$j++) {
                $minors[$i][$j] *= self::$cofactors[$i][$j];
            }
        }

        // Adjugate.
        $minors->transpose();
        $div = 1 / $determinant;
        for ($x=0;$x<$this->rows;$x++) {
            for ($y=0;$y<$this->columns;$y++) {
                $minors[$x][$y] *= $div;
            }
        }

        $this->copy($minors);
    }

    public function offsetGet($offset) {
        if (!$this->offsetExists($offset)) {
            throw new Exception("Out of range. This matrix has $this->columns * $this->rows indexes.");
        }

        return $this->vectors[$offset];
    }

    public function offsetExists($offset) {
        return is_numeric($offset) && $offset >= 0 && $offset < $this->columns;
    }

    public function offsetSet($offset, $value) {
        throw new Exception("Invalid operation.");

    }

    public function offsetUnset($offset) {
        throw new Exception("Invalid operation.");
    }

    /**
     * Copy the matrix to another matrix.
     *
     * @param Matrix $matrix
     */
    protected function copy(Matrix $matrix) {
        for ($i=0;$i<$matrix->rows;$i++) {
            for ($j=0;$j<$matrix->columns;$j++) {
                $this->vectors[$i][$j] = $matrix[$i][$j];
            }
        }
    }
}
