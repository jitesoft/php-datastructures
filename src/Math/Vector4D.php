<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector4D.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Vector4DMath as _;

/**
 * Class Vector4D
 *
 * A vector structure in four dimentional space.
 */
class Vector4D {

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
     * Calculate dot product between two vectors.
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

    }

    /**
     * Squared vector length.
     *
     * @return float
     */
    public function length2() : float {

    }

    /**
     * Normalizes the vector.
     */
    public function normalize() {

    }

}
