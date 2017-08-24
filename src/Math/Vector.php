<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use ArrayAccess;
use Jitesoft\Utilities\DataStructures\Math\Traits\VectorAccessTrait;

/**
 * Class Vector
 *
 * Baseclass for all vector structures.
 */
abstract class Vector  implements ArrayAccess {
    use VectorAccessTrait;

    /**
     * Number of elements the vector consists of.
     * Example:
     * <pre>
     * Vector2D consists of two elements [0, 1].
     * Vector3D consists of three elements [0, 1, 2].
     * </pre>
     *
     * Observe:
     * The element count constant will be removed at a later point, so do not depend on it.
     */
    public const ELEMENT_COUNT = 0;

    /**
     * Array of offsets used in VectorAccessTrait.
     * Should map all possible offsets to the lower case character for the offset.
     * Example:
     * <pre>
     * Vector2D offsets:
     * [
     *   0 => 'x', 'X' => 'x', 'x' => 'x',
     *   1 => 'y', 'Y' => 'y', 'y' => 'y'
     * ]
     * </pre>
     *
     * Observe:
     * The offsets mapping will be removed at a later point.
     */
    protected const OFFSETS = [];

    /**
     * @param Vector $vector
     */
    protected function copy(Vector $vector) {
        for ($i=0;$i<static::ELEMENT_COUNT;$i++) {
            $this[$i] = $vector[$i];
        }
    }

    /**
     * Vector length.
     *
     * @return float
     */
    public function length() : float {
        return sqrt($this->length2());
    }

    /**
     * Squared vector length.
     *
     * @return float
     */
    public function length2() : float {
        $value = 0;
        for ($i=0;$i<static::ELEMENT_COUNT;$i++) {
            $value += ($this[$i] * $this[$i]);
        }
        return $value;
    }


    /**
     * Vector multiplication.
     *
     * @param float|Vector $value
     */
    public function mul($value) {
        $this->copy(VectorMath::mul($this, $value));

    }

    /**
     * Vector division.
     *
     * @param float|Vector $value
     */
    public function div($value) {
        $this->copy(VectorMath::div($this, $value));
    }

    /**
     * Vector addition.
     *
     * @param Vector $value
     */
    public function add(Vector $value) {
        $this->copy(VectorMath::add($this, $value));
    }

    /**
     * Vector subtraction.
     *
     * @param Vector $value
     */
    public function sub(Vector $value) {
        $this->copy(VectorMath::sub($this, $value));
    }

    /**
     * Calculate dot product of two vectors.
     *
     * @param Vector $value
     * @return float
     */
    public function dot(Vector $value) {
        return VectorMath::dot($this, $value);
    }

    /**
     * Calculate distance between two vectors.
     *
     * @param Vector $value
     * @return float
     */
    public function distance(Vector $value) : float {
        return VectorMath::distance($this, $value);
    }

    /**
     * Calculate square distance between two vectors.
     *
     * @param Vector $value
     * @return float
     */
    public function distance2(Vector $value) {
        return VectorMath::distance2($this, $value);
    }

    /**
     * Normalizes the vector.
     */
    public function normalize() {
        $len =  $this->length();

        if ($len === 0.0) {
            return;
        }

        for ($i=0;$i<static::ELEMENT_COUNT;$i++) {
            $this[$i] /= $len;
        }
    }


}
