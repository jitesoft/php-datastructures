<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  SimpleMap.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Maps;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Lists\IndexedListInterface;

class SimpleMap implements MapInterface {

    /**
     * Get number of objects in the collection.
     *
     * @alias count()
     * @return int
     */
    public function length(): int {
        // TODO: Implement length() method.
    }

    /**
     * Get number of objects in the collection.
     *
     * @return int
     */
    public function count(): int {
        // TODO: Implement count() method.
    }

    /**
     * Get number of objects in the collection.
     *
     * @alias count()
     * @return int
     */
    public function size(): int {
        // TODO: Implement size() method.
    }

    /**
     * Clear the collection of all objects.
     *
     * @return bool
     */
    public function clear(): bool {
        // TODO: Implement clear() method.
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset) {
        // TODO: Implement offsetExists() method.
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset) {
        // TODO: Implement offsetGet() method.
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value) {
        // TODO: Implement offsetSet() method.
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset) {
        // TODO: Implement offsetUnset() method.
    }

    /**
     * MapInterface constructor.
     *
     * @param array|null $array Optional associative array to use as base.
     */
    public function __construct($array = null) {
        parent::__construct($array);
    }

    /**
     * Get the value of a given key.
     * If the key does not exist, a InvalidArgumentException will be thrown.
     *
     * @param string $key
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get(string $key) {
        // TODO: Implement get() method.
    }

    /**
     * Set a given keys value.
     * If the key already exists, it will be overwritten.
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function add(string $key, $value): bool {
        // TODO: Implement add() method.
    }

    /**
     * Check if a key exists in the map.
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool {
        // TODO: Implement has() method.
    }

    /**
     * Converts the map to a associative php array.
     *
     * @return array
     */
    public function toAssocArray(): array {
        // TODO: Implement toAssocArray() method.
    }

    /**
     * Fetches all keys as a indexed list.
     *
     * @return IndexedListInterface|string[]
     */
    public function keys(): IndexedListInterface {
        // TODO: Implement keys() method.
    }

    /**
     * Fetches all values as a indexed list.
     *
     * @return IndexedListInterface|mixed[]
     */
    public function values(): IndexedListInterface {
        // TODO: Implement values() method.
    }

    /**
     * Removes a given key-value pair.
     *
     * @param string $key
     * @return bool
     */
    public function unset(string $key): bool {
        // TODO: Implement unset() method.
    }
}
