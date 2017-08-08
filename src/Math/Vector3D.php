<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector3D.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math;

use ArrayAccess;
use Exception;
use Jitesoft\Utilities\DataStructures\Math\Point3D as Point;
use Jitesoft\Utilities\DataStructures\Math\Vector3DMath as _;

/**
 * Class Vector3D
 *
 * Vector structure in 3D space.
 *
 * A vector consists of three floating point numbers and can be accessed through
 * either their get-accessors (getX, getY, getZ) or through array access.
 * (x/X/0, y/Y/1, z/Z/2).
 */
class Vector3D extends Point implements ArrayAccess {

    /** @var array */
    private $offsets = [
        'x' => 'x', 'X' => 'x', 0 => 'x',
        'y' => 'y', 'Y' => 'y', 1 => 'y',
        'z' => 'z', 'Z' => 'z', 2 => 'z'
    ];

    /**
     * Create a Vector3D.
     *
     * Vector3D constructor.
     *
     * @param float $x
     * @param float $y
     * @param float $z
     */
    public function __construct(float $x = 0, float $y = 0, float $z = 0) {
        parent::__construct($x, $y, $z);
    }


    /**
     * Vector addition.
     *
     * @param Point $v2
     */
    public function add(Point $v2) {
        $this->copy(_::add($this, $v2));
    }

    /**
     * Vector subtraction.
     *
     * @param Point $v2
     */
    public function sub(Point $v2) {
        $this->copy(_::sub($this, $v2));
    }

    /**
     * Vector multiplication.
     *
     * @param Point|float $v2
     */
    public function mul($v2) {
        $this->copy(_::mul($this, $v2));
    }

    /**
     * @param Point|float $v2
     */
    public function div($v2) {
        $this->copy(_::div($this, $v2));
    }

    /**
     * @param Point $vector2
     * @return float
     */
    public function distance(Point $vector2) : float {
        return _::distance($this, $vector2);
    }

    /**
     * @param Point $vector2
     * @return float
     */
    public function distance2(Point $vector2) : float {
        return _::distance2($this, $vector2);
    }

    /**
     * Calculates the dot product of two vectors.
     *
     * @param Point $vector2
     * @return float
     */
    public function dot(Point $vector2) : float {
        return _::dot($this, $vector2);
    }

    /**
     * Calculates the cross product of two vectors.
     *
     * @param Point $vector
     */
    public function cross(Point $vector) {
        $this->copy(_::cross($this, $vector));
    }

    /**
     * Calculate the vector length.
     *
     * @return float
     */
    public function length() : float {
        return sqrt($this->length2());
    }

    /**
     * Calculate the vectors squared length.
     *
     * @return float
     */
    public function length2() : float {
        return
            ($this->x * $this->x)
            +
            ($this->y * $this->y)
            +
            ($this->z * $this->z);
    }

    /**
     * Normalize the vector.
     */
    public function normalize() {
        $len = $this->length();
        if($len <= 0) {
            return;
        }
        $this->div($len);
    }

    /**
     * @param mixed $offset
     * @param mixed $default
     * @return null|string|bool
     * @throws Exception
     */
    private function convertOffset($offset, $default = null) {
        if (array_key_exists($offset, $this->offsets)) {
            return $this->offsets[$offset];
        }

        if ($default !== null) {
            return $default;
        }
        throw new Exception("Out of range. This vector has three indexes (0,1,2)/(x,y,z).");
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset) {
        return $this->convertOffset($offset, false) !== false;
    }

    /**
     * @param mixed $offset
     * @return float
     * @throws Exception
     */
    public function offsetGet($offset) {
        $offset = $this->convertOffset($offset);
        return $this->{$offset};
    }

    /**
     * @param int $offset
     * @param float $value
     * @throws Exception
     */
    public function offsetSet($offset, $value) {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException("Invalid value. Value must be a number.");
        }
        $offset = $this->convertOffset($offset);
        $this->{$offset} = $value;
    }

    /**
     * @param mixed $offset
     * @throws Exception
     */
    public function offsetUnset($offset) {
        throw new Exception("Invalid method.");
    }

    /**
     * Make the given vector a copy of another vector.
     * Basically assigns X and Y of the vector to the X and Y of passed point/vector.
     *
     * @param Point $copy
     */
    private function copy(Point $copy) {
        $this->x = $copy->x;
        $this->y = $copy->y;
        $this->z = $copy->z;
    }

}
