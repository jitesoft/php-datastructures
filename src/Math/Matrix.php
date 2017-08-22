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

    const SIGN_CHART = [
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
     * Matrix multiplication.
     *
     * @param float|Matrix $value
     */
    public abstract function mul($value);

    /**
     * Matrix addition.
     *
     * @param Matrix $value
     */
    public abstract function add(Matrix $value);

    /**
     * Matrix subtraction.
     *
     * @param Matrix $value
     */
    public abstract function sub(Matrix $value);

    /**
     * Turn the matrix into a identity matrix.
     */
    public abstract function identity();

    /**
     * Calculate the matrix determinant.
     *
     * @return float
     */
    public function determinant() : float {
        return MatrixMath::calculateDeterminant($this->toArray());
    }


    /**
     * Get the minors matrix of the matrix.
     *
     * @return Matrix
     */
    public function getAdjoinMatrix() : Matrix {
        $matrix = new static();
        for ($i=0;$i<$this->rows;$i++) {
            for ($j=0;$j<$this->columns;$j++) {
                $cofactor       = MatrixMath::getCofactor($this->toArray(), $i, $j);
                $matrix[$i][$j] = MatrixMath::calculateDeterminant($cofactor);
            }
        }
        return $matrix;
    }

    /**
     * Transpose the matrix.
     */
    public function transpose() {
        $cpy = new static();
        $cpy->copy($this);

        for ($i=0;$i<$this->rows;$i++) {
            for ($j=0;$j<$this->columns;$j++) {
                $this[$i][$j] = $cpy[$j][$i];
            }
        }

    }

    /**
     * Alias for Matrix::setRotationX
     * @see Matrix::setRotationX()
     *
     * @param float $angle
     * @param string $type
     */
    public function roll(float $angle, string $type = Math::DEGREES) {
        $this->setRotationX($angle, $type);
    }

    /**
     * Alias for Matrix::setRotationY
     * @see Matrix::setRotationY()
     *
     * @param float $angle
     * @param string $type
     */
    public function pitch(float $angle, string $type = Math::DEGREES) {
        $this->setRotationY($angle, $type);
    }

    /**
     * Alias for Matrix::setRotationZ
     * @see Matrix::setRotationZ()
     *
     * @param float $angle
     * @param string $type
     */
    public function yaw(float $angle, string $type = Math::DEGREES) {
        $this->setRotationZ($angle, $type);
    }

    /**
     * Rotate the matrix in X by given angle.
     * This is commonly called "Roll".
     *
     * @param float $angle
     * @param string $type
     */
    public abstract function setRotationX(float $angle, string $type = Math::DEGREES);

    /**
     * Rotate the matrix in Y by given angle.
     * This is commonly called "Pitch".
     *
     * @param float $angle
     * @param string $type
     */
    public abstract function setRotationY(float $angle, string $type = Math::DEGREES);

    /**
     * Rotate the matrix in Z by given angle.
     * This is commonly called "Yaw".
     *
     * @param float $angle
     * @param string $type
     */
    public abstract function setRotationZ(float $angle, string $type = Math::DEGREES);

    /**
     * Inverse the matrix.
     */
    public function inverse() {
        $determinant = $this->determinant();
        if ($determinant === 0) { // If 0, there is no inverse.
            return;
        }

        $adj  = $this->getAdjoinMatrix();
        $sign = 1;
        for ($i=0;$i<$this->rows;$i++) {
            for ($j=0;$j<$this->columns;$j++) {
                $sign        = Matrix::SIGN_CHART[$i][$j];
                $adj[$i][$j] = $sign * $adj[$i][$j];
            }
        }

        $this->copy($adj);
        $this->transpose();
        $div = 1 / $determinant;
        $this->mul($div);
    }

    public function offsetGet($offset) {
        if (!$this->offsetExists($offset)) {
            throw new Exception("Out of range. This matrix has $this->columns * $this->rows indexes.");
        }

        return $this->vectors[$offset];
    }

    public function offsetExists($offset) {
        return is_numeric($offset) && $offset >= 0 && $offset < $this->rows;
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

    /**
     * @return float[][] Array representation of the matrix.
     */
    protected function toArray() {
        $out = [];
        for ($i=0;$i<$this->rows;$i++) {
            $out[$i] = [];
            for ($j=0;$j<$this->columns;$j++) {
                $out[$i][$j] = $this[$i][$j];
            }
        }
        return $out;
    }

    protected function fromArray(array $array) {
        $rows   = count($array);
        $cols   = count($array[0]);
        $matrix = new static();

        for ($i=$rows;$i-->0;) {
            for ($j=$cols;$j-->0;) {
                $matrix[$i][$j] = $array[$i][$j];
            }
        }
    }
}
