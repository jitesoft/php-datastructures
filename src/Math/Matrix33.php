<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix33.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

/**
 * Class Matrix33
 *
 * A 3x3 matrix structure.
 *
 * @deprecated as of 1.2.0
 * @see https://github.com/jitesoft/php-math
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
    public function setRotationX(float $angle, string $type = Math::DEGREES) {
        $rotationMatrix = MatrixMath::makeRotationX($angle, $type);
        $this->mul($rotationMatrix);
    }

    /**
     * {@inheritDoc}
     */
    public function setRotationY(float $angle, string $type = Math::DEGREES) {
        $rotationMatrix = MatrixMath::makeRotationY($angle, $type);
        $this->mul($rotationMatrix);

    }

    /**
     * {@inheritDoc}
     */
    public function setRotationZ(float $angle, string $type = Math::DEGREES) {
        $rotationMatrix = MatrixMath::makeRotationZ($angle, $type);
        $this->mul($rotationMatrix);
    }
}
