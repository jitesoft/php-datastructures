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

    public const COLUMNS = 3;
    public const ROWS    = 3;

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
