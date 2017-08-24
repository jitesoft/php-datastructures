<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  VectorAccessTrait.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Math\Traits;

use Exception;
use InvalidArgumentException;

/**
 * Trait VectorAccessTrait
 *
 * Trait used by Vector structures to enable array access by any type of offset set in the $offset variable.
 */
trait VectorAccessTrait {

    /**
     * @param mixed $offset
     * @param mixed $default
     * @return null|string|bool
     * @throws Exception
     */
    private function convertOffset($offset, $default = null) {
        if (array_key_exists(mb_strtoupper($offset), static::OFFSETS)) {
            return static::OFFSETS[mb_strtoupper($offset)];
        }

        if ($default !== null) {
            return $default;
        }
        throw new Exception("Out of range. Invalid offset.");
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
            throw new InvalidArgumentException("Invalid value. Value must be a number.");
        }
        $offset          = $this->convertOffset($offset);
        $this->{$offset} = $value;
    }

    /**
     * @param mixed $offset
     * @throws Exception
     */
    public function offsetUnset($offset) {
        throw new Exception("Invalid method.");
    }
}