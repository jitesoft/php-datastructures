<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix44.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Matrix44Math as _;

/**
 * Class Matrix44
 *
 * A 4x4 matrix structure.
 */
class Matrix44 extends Matrix {

    protected $columns = 4;
    protected $rows    = 4;

    public function __construct(
        float $x1 = 1, float $y1 = 0, float $z1 = 0, float $w1 = 0,
        float $x2 = 0, float $y2 = 1, float $z2 = 0, float $w2 = 0,
        float $x3 = 0, float $y3 = 0, float $z3 = 1, float $w3 = 0,
        float $x4 = 0, float $y4 = 0, float $z4 = 0, float $w4 = 1) {

        $this->vectors[0] = new Vector4D($x1, $y1, $z1, $w1);
        $this->vectors[1] = new Vector4D($x2, $y2, $z2, $w2);
        $this->vectors[2] = new Vector4D($x3, $y3, $z3, $w3);
        $this->vectors[3] = new Vector4D($x4, $y4, $z4, $w4);
    }

    /**
     * {@inheritdoc}
     *
     * @param float|Matrix44|Matrix33|Vector4D $value
     */
    public function mul($value) {
        $this->copy(_::mul($this, $value));
    }

    /**
     * {@inheritdoc}
     */
    public function add(Matrix $value) {
        $this->copy(_::add($this, $value));
    }

    /**
     * {@inheritdoc}
     */
    public function sub(Matrix $value) {
        $this->copy(_::sub($this, $value));
    }

    /**
     * {@inheritdoc}
     */
    public function identity() {
        // TODO: Implement identity() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getMinors(): Matrix {
        // TODO: Implement getMinors() method.
    }


    /**
     * {@inheritdoc}
     */
    public function setRotationX(float $angle, string $type = Math::DEGREES) {
        // TODO: Implement setRotationX() method.
    }

    /**
     * {@inheritdoc}
     */
    public function setRotationY(float $angle, string $type = Math::DEGREES) {
        // TODO: Implement setRotationY() method.
    }

    /**
     * {@inheritdoc}
     */
    public function setRotationZ(float $angle, string $type = Math::DEGREES) {
        // TODO: Implement setRotationZ() method.
    }
}
