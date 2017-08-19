<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector4D.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use ArrayAccess;
use Jitesoft\Utilities\DataStructures\Math\Vector4DMath as _;
use Jitesoft\Utilities\DataStructures\Traits\VectorAccessTrait;

/**
 * Class Vector4D
 *
 * A vector structure in four dimensional space.
 *
 *
 * A vector consists of four floating point numbers and can be accessed through
 * either their get-accessors (getX, getY, getZ, getW) or through array access.
 * (x/X/0, y/Y/1, z/Z/2, w/W/3).
 */
class Vector4D implements ArrayAccess {
    use VectorAccessTrait;

    /** @var array */
    protected $offsets = [
        'x' => 'x', 'X' => 'x', 0 => 'x',
        'y' => 'y', 'Y' => 'y', 1 => 'y',
        'z' => 'z', 'Z' => 'z', 2 => 'z',
        'w' => 'w', 'W' => 'w', 3 => 'w'
    ];

    /**
     * @param Vector4D $cpy
     */
    private function copy(Vector4D $cpy) {
        $this->x = $cpy->x;
        $this->y = $cpy->y;
        $this->z = $cpy->z;
        $this->w = $cpy->w;
    }

    /** @var float */
    protected $x;
    /** @var float */
    protected $y;
    /** @var float */
    protected $z;
    /** @var float */
    protected $w;

    /**
     * Create a 4 dimensional vector.
     *
     * Vector4D constructor.
     * @param float $x
     * @param float $y
     * @param float $z
     * @param float $w
     */
    public function __construct(float $x = 0, float $y = 0, float $z = 0, float $w = 0) {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->w = $w;
    }

    /**
     * Get the X-Coordinate.
     *
     * @return float
     */
    public function getX(): float {
        return $this->x;
    }

    /**
     * Set the X-Coordinate.
     *
     * @param float $x
     */
    public function setX(float $x) {
        $this->x = $x;
    }

    /**
     * Get the Y-Coordinate.
     *
     * @return float
     */
    public function getY(): float {
        return $this->y;
    }

    /**
     * Set the Y-Coordinate.
     *
     * @param float $y
     */
    public function setY(float $y) {
        $this->y = $y;
    }

    /**
     * Get the Z-Coordinate.
     *
     * @return float
     */
    public function getZ(): float {
        return $this->z;
    }

    /**
     * Set the Z-Coordinate.
     *
     * @param float $z
     */
    public function setZ(float $z) {
        $this->z = $z;
    }

    /**
     * Get the W-Coordinate.
     *
     * @return float
     */
    public function getW(): float {
        return $this->w;
    }

    /**
     * Set the W-Coordinate.
     *
     * @param float $w
     */
    public function setW(float $w) {
        $this->w = $w;
    }

    /**
     * Vector multiplication.
     *
     * @param float|Vector4D $value
     */
    public function mul($value) {
        $this->copy(_::mul($this, $value));

    }

    /**
     * Vector division.
     *
     * @param float|Vector4D $value
     */
    public function div($value) {
        $this->copy(_::div($this, $value));
    }

    /**
     * Vector addition.
     *
     * @param Vector4D $value
     */
    public function add(Vector4D $value) {
        $this->copy(_::add($this, $value));
    }

    /**
     * Vector subtraction.
     *
     * @param Vector4D $value
     */
    public function sub(Vector4D $value) {
        $this->copy(_::sub($this, $value));
    }

    /**
     * Calculate dot product of two vectors.
     *
     * @param Vector4D $value
     * @return float
     */
    public function dot(Vector4D $value) {
        return _::dot($this, $value);
    }

    /**
     * Calculate distance between two vectors.
     *
     * @param Vector4D $value
     * @return float
     */
    public function distance(Vector4D $value) : float {
        return _::distance($this, $value);
    }

    /**
     * Calculate square distance between two vectors.
     *
     * @param Vector4D $value
     * @return float
     */
    public function distance2(Vector4D $value) {
        return _::distance2($this, $value);
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
        return
            ($this->x * $this->x)
            +
            ($this->y * $this->y)
            +
            ($this->z * $this->z)
            +
            ($this->w * $this->w);
    }

    /**
     * Normalizes the vector.
     */
    public function normalize() {
        $len = $this->length();

        $this->x /= $len;
        $this->y /= $len;
        $this->z /= $len;
        $this->w /= $len;
    }

}
