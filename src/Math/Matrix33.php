<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix33.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Matrix33Math as _;
use ArrayAccess;
use Exception;

/**
 * Class Matrix33
 *
 * A 3x3 matrix structure.
 */
class Matrix33 implements ArrayAccess {

    /** @var int[][] */
    private static $cofactors = [
        [1, -1, 1],
        [-1, 1, -1],
        [1, -1, 1]
    ];

    /** @var Vector3D[] */
    private $vectors;

    private function copy(Matrix33 $matrix) {
        for ($i=0;$i<3;$i++) {

            $this->vectors[$i] = new Vector3D(
                $matrix[$i]->getX(),
                $matrix[$i]->getY(),
                $matrix[$i]->getZ()
            );
        }
    }

    public function __construct(
        float $x1 = 1, float $y1 = 0, float $z1 = 0,
        float $x2 = 0, float $y2 = 1, float $z2 = 0,
        float $x3 = 0, float $y3 = 0, float $z3 = 1) {

        $this->vectors[0] = new Vector3D($x1, $y1, $z1);
        $this->vectors[1] = new Vector3D($x2, $y2, $z2);
        $this->vectors[2] = new Vector3D($x3, $y3, $z3);
    }


    public function transpose() {
        $cpy = new Matrix33();
        $cpy->copy($this);

        for ($i=0;$i<3;$i++) {
            for ($j=0;$j<3;$j++) {
                $this[$i][$j] = $cpy[$j][$i];
            }
        }
    }

    /**
     * Turn the matrix into a identity matrix.
     *
     * <pre>
     *  [1,0,0]
     *  [0,1,0]
     *  [0,0,1]
     * </pre>
     */
    public function identity() {
        $this->copy(_::identity());
    }


    public function inverse() {
        $determinant = $this->determinant();
        if ($determinant === 0) { // If 0, there is no inverse.
            return;
        }

        $minors = $this->getMinors();
        for ($i=0;$i<3;$i++) {
            for ($j=0;$j<3;$j++) {
                $minors[$i][$j] *= self::$cofactors[$i][$j];
            }
        }

        // Adjugate.
        $minors->transpose();
        $div = 1 / $determinant;
        for ($x=0;$x<3;$x++) {
            for ($y=0;$y<3;$y++) {
                    $minors[$x][$y] *= $div;
            }
        }

        $this->copy($minors);
    }

    /**
     * Get the minors of the given matrix.
     *
     * <pre>
     * Calculation used to get minors:
     *
     *
     * For each "Minor", calculate the 2x2 determinate
     *
     *   I.E.,
     *   [a] [b]
     *   [c] [d]
     *
     *   D = a*d - b*c
     *
     *   The matrix is defined as following:
     *   0 [X][Y][Z]
     *   1 [X][Y][Z]
     *   2 [X][Y][Z]
     *
     *   Where calculations of the minors are:
     *   [1Y*2Z - 1Z*2Y] [1X*2Z - 1Z*2X] [1X*2Y - 1Y*2X]
     *
     *   [0Y*2Z - 0Z*2Y] [0X*2Z - 0Z*2X] [0X*2Y - 0Y*2X]
     *
     *   [0Y*1Z - 0Z*1Y] [0X*1Z - 0Z*1X] [0X*1Y - 0Y*1X]
     * </pre>
     * @return Matrix33
     */
    public function getMinors() : Matrix33 {
        return new Matrix33(
            ($this[1]["Y"] * $this[2]["Z"]) - ($this[1]["Z"] * $this[2]["Y"]),
            ($this[1]["X"] * $this[2]["Z"]) - ($this[1]["Z"] * $this[2]["X"]),
            ($this[1]["X"] * $this[2]["Y"]) - ($this[1]["Y"] * $this[2]["X"]),

            ($this[0]["Y"] * $this[2]["Z"]) - ($this[0]["Z"] * $this[2]["Y"]),
            ($this[0]["X"] * $this[2]["Z"]) - ($this[0]["Z"] * $this[2]["X"]),
            ($this[0]["X"] * $this[2]["Y"]) - ($this[0]["Y"] * $this[2]["X"]),

            ($this[0]["Y"] * $this[1]["Z"]) - ($this[0]["Z"] * $this[1]["Y"]),
            ($this[0]["X"] * $this[1]["Z"]) - ($this[0]["Z"] * $this[1]["X"]),
            ($this[0]["X"] * $this[1]["Y"]) - ($this[0]["Y"] * $this[1]["X"])
        );
    }

    /**
     * Calculate matrix determinant using laplace expansion.
     *
     * @return float
     */
    public function determinant() : float {
        return
            ($this[0][0] * (($this[1][1] * $this[2][2]) - ($this[1][2] * $this[2][1]))) -
            ($this[0][1] * (($this[1][0] * $this[2][2]) - ($this[1][2] * $this[2][0]))) +
            ($this[0][2] * (($this[1][0] * $this[2][1]) - ($this[1][1] * $this[2][0])));
    }

    /**
     * @param Matrix33|float $value
     * @throws Exception
     */
    public function mul($value) {
        $this->copy(_::mul($this, $value));
    }

    /**
     * @param Matrix33 $value
     */
    public function add(Matrix33 $value) {
        $this->copy(_::add($this, $value));
    }

    /**
     * @param Matrix33|float $value
     */
    public function sub($value) {
        $this->copy(_::sub($this, $value));
    }

    /**
     * @alias to Matrix33::setRotationX
     * @see Matrix33::setRotationX()
     *
     * @param float $angle
     * @param string $type
     */
    public function roll(float $angle, string $type = Math::DEGREES) {
        $this->setRotationX($angle, $type);
    }


    /**
     * @alias to Matrix33::setRotationY
     * @see Matrix33::setRotationY()
     *
     * @param float $angle
     * @param string $type
     */
    public function pitch(float $angle, string $type = Math::DEGREES) {
        $this->setRotationY($angle, $type);
    }


    /**
     * @alias to Matrix33::setRotationZ
     * @see Matrix33::setRotationZ()
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
    public function setRotationX(float $angle, string $type = Math::DEGREES) {
        $rotationMatrix = _::makeRotationX($angle, $type);
        $this->mul($rotationMatrix);
    }

    /**
     * Rotate the matrix in Y by given angle.
     * This is commonly called "Pitch".
     *
     * @param float $angle
     * @param string $type
     */
    public function setRotationY(float $angle, string $type = Math::DEGREES) {
        $rotationMatrix = _::makeRotationY($angle, $type);
        $this->mul($rotationMatrix);

    }

    /**
     * Rotate the matrix in Z by given angle.
     * This is commonly called "Yaw".
     *
     * @param float $angle
     * @param string $type
     */
    public function setRotationZ(float $angle, string $type = Math::DEGREES) {
        $rotationMatrix = _::makeRotationZ($angle, $type);
        $this->mul($rotationMatrix);
    }

    public function offsetGet($offset) {
        if (!$this->offsetExists($offset)) {
            throw new Exception("Out of range. This matrix has three * three indexes [0,1,2][0,1,2].");
        }

        return $this->vectors[$offset];
    }

    public function offsetExists($offset) {
        return is_numeric($offset) && $offset >= 0 && $offset < 3;
    }

    public function offsetSet($offset, $value) {
        throw new Exception("Invalid operation.");

    }

    public function offsetUnset($offset) {
        throw new Exception("Invalid operation.");
    }
}
