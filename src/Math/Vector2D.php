<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector2D.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use Jitesoft\Utilities\DataStructures\Math\Point2D as Point;

/**
 * Class Vector2D
 *
 * Vector structure in 2D space.
 */
class Vector2D extends Point2D {

    /**
     * Create a Vector2D instance.
     *
     * Vector2D constructor.
     *
     * @param float $x Initial X-Coordinate.
     * @param float $y Initial Y-Coordinate.
     */
    public function __construct(float $x = 0, float $y = 0) {
        parent::__construct($x, $y);
    }

    /**
     * Set the X and Y coordinate of the vector.
     *
     * @param float $x X-Coordinate.
     * @param float $y Y-Coordinate.
     */
    public function set(float $x, float $y) {
        $this->setX($x);
        $this->setY($y);
    }

    /**
     * Get the length of the vector.
     *
     * @return float Length.
     */
    public function length() : float {
        return sqrt($this->length2());
    }

    /**
     * Get the length of the vector squared for faster operation.
     *
     * @return float Length squared.
     */
    public function length2() : float {
        return
            $this->x * $this->x
            +
            $this->y * $this->y;
    }

    /**
     * Normalize the vector.
     */
    public function normalize() {
        $len = $this->length();

        if ($len <= 0) {
            return;
        }

        $this->div($len);
    }

    /**
     * Calculate the distance between two vectors.
     *
     * @param Point2D $value
     * @return float Distance.
     */
    public function distance(Point2D $value) : float {
        return sqrt($this->distance2($value));
    }

    /**
     * Calculate the distance between two vectors squared for faster operation.
     *
     * @param Point2D $value
     * @return float Distance squared.
     */
    public function distance2(Point2D $value) : float {
        return
            ($this->x - $value->x) * ($this->x - $value->x)
            +
            ($this->y - $value->y) * ($this->y - $value->y);
    }

    /**
     * Vector addition.
     *
     * @param Point|Vector2D $value
     */
    public function add(Point $value) {
        $this->x += $value->x;
        $this->y += $value->y;
    }

    /**
     * Vector subtraction.
     *
     * @param Point|Vector2D $value
     */
    public function sub(Point $value) {
        $this->x -= $value->x;
        $this->y -= $value->y;
    }

    /**
     * Vector multiplication.
     *
     * @param Vector2D|Point|float $value
     */
    public function mul($value) {
        if (is_numeric($value)) {
            $this->mul_f($value);
            return;
        }

        $this->x *= $value->x;
        $this->y *= $value->y;
    }

    /**
     * Vector division.
     *
     * @param Vector2D|Point|float $value
     */
    public function div($value) {
        if (is_numeric($value)) {
            $this->div_f($value);
            return;
        }

        $this->x /= $value->x;
        $this->y /= $value->y;
    }

    /**
     * Dot product.
     *
     * @param Point2D $value
     * @return float
     */
    public function dot(Point $value) : float {
        return
            $this->x * $value->x
            +
            $this->y * $value->y;
    }

    /**
     * Vector multiplication with a float value.
     *
     * @param float $float
     */
    private function mul_f(float $float) {
        $this->x *= $float;
        $this->y *= $float;
    }

    /**
     * Vector division with a float value.
     *
     * @param float $float
     */
    private function div_f(float $float) {
        $this->x /= $float;
        $this->y /= $float;
    }
}
