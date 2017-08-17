<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix33.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Math;

use ArrayAccess;

/**
 * Class Matrix33
 *
 * A 3x3 matrix structure.
 */
class Matrix33 implements ArrayAccess {

    /** @var Vector3D */
    private $x;
    /** @var Vector3D */
    private $y;
    /** @var Vector3D */
    private $z;

    private function setX($x, $y, $z) {
        $this->x->setX($x);
        $this->x->setX($y);
        $this->x->setX($z);
    }

    private function setY($x, $y, $z) {
        $this->y->setX($x);
        $this->y->setX($y);
        $this->y->setX($z);
    }

    private function setZ($x, $y, $z) {
        $this->z->setX($x);
        $this->z->setX($y);
        $this->z->setX($z);
    }


    public function __construct(
        float $x1 = 0, float $y1 = 0, float $z1 = 0,
        float $x2 = 0, float $y2 = 0, float $z2 = 0,
        float $x3 = 0, float $y3 = 0, float $z3 = 0) {

        $this->x = new Vector3D($x1, $y1, $z1);
        $this->y = new Vector3D($x2, $y2, $z2);
        $this->z = new Vector3D($x3, $y3, $z3);
    }

    public function offsetGet($offset) {

    }

    public function offsetExists($offset) {
        return is_numeric($offset) && $offset >= 0 && $offset < 3;
    }

    public function offsetSet($offset, $value) {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset) {
        // TODO: Implement offsetUnset() method.
    }
}
