<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix33.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Matrix33Math as _;

/**
 * Class Matrix33
 *
 * A 3x3 matrix structure.
 */
class Matrix33 extends Matrix {

    protected $columns = 3;
    protected $rows    = 3;

    public function __construct(
        float $x1 = 1, float $y1 = 0, float $z1 = 0,
        float $x2 = 0, float $y2 = 1, float $z2 = 0,
        float $x3 = 0, float $y3 = 0, float $z3 = 1) {

        $this->vectors[0] = new Vector3D($x1, $y1, $z1);
        $this->vectors[1] = new Vector3D($x2, $y2, $z2);
        $this->vectors[2] = new Vector3D($x3, $y3, $z3);
    }

    /**
     * {@inheritDoc}
     */
    public function identity() {
        $this->copy(_::identity());
    }


    /**
     * {@inheritDoc}
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
     * @return Matrix
     */
    public function getMinors() : Matrix {
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
     * {@inheritDoc}
     */
    public function mul($value) {
        $this->copy(_::mul($this, $value));
    }

    /**
     * {@inheritDoc}
     */
    public function add(Matrix $value) {
        $this->copy(_::add($this, $value));
    }

    /**
     * {@inheritDoc}
     */
    public function sub(Matrix $value) {
        $this->copy(_::sub($this, $value));
    }

    /**
     * {@inheritDoc}
     */
    public function setRotationX(float $angle, string $type = Math::DEGREES) {
        $rotationMatrix = _::makeRotationX($angle, $type);
        $this->mul($rotationMatrix);
    }

    /**
     * {@inheritDoc}
     */
    public function setRotationY(float $angle, string $type = Math::DEGREES) {
        $rotationMatrix = _::makeRotationY($angle, $type);
        $this->mul($rotationMatrix);

    }

    /**
     * {@inheritDoc}
     */
    public function setRotationZ(float $angle, string $type = Math::DEGREES) {
        $rotationMatrix = _::makeRotationZ($angle, $type);
        $this->mul($rotationMatrix);
    }
}
