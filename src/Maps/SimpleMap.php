<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  SimpleMap.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Maps;

use ArrayIterator;
use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Exceptions\Logic\OutOfBoundsException;
use Jitesoft\Utilities\DataStructures\Lists\IndexedList;
use Jitesoft\Utilities\DataStructures\Lists\IndexedListInterface;
use Jitesoft\Utilities\DataStructures\Traits\MapMethodsTrait;
use Traversable;

/**
 * Class SimpleMap
 *
 * A map structure which uses a native associative array as base.
 */
class SimpleMap implements MapInterface {
    use MapMethodsTrait;

    /** @var array */
    private $innerMap;
    /** @var integer */
    private $count;

    /**
     * MapInterface constructor.
     *
     * @param array|null $array Optional associative array to use as base.
     */
    public function __construct(?array $array = null) {
        $this->innerMap = $array ?? [];
        $this->count    = count($this->innerMap);
    }

    /**
     * Get number of objects in the collection.
     *
     * @alias count
     * @return integer
     */
    public function length(): int {
        return $this->count();
    }

    /**
     * Get number of objects in the collection.
     *
     * @return integer
     */
    public function count(): int {
        return $this->count;
    }

    /**
     * Get number of objects in the collection.
     *
     * @alias count
     * @return integer
     */
    public function size(): int {
        return $this->count();
    }

    /**
     * Clear the collection of all objects.
     *
     * @return boolean
     */
    public function clear(): bool {
        $this->count    = 0;
        $this->innerMap = [];
        return true;
    }

    /**
     * @param mixed $offset Offset to test for.
     * @return mixed
     */
    public function offsetExists($offset) {
        return $this->has($offset);
    }

    /**
     * @param mixed $offset Offset to fetch.
     * @return mixed
     * @throws InvalidArgumentException On out of bounds error. Deprecated and will change to OutOfBoundsException in next major release.
     */
    public function offsetGet($offset) {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset Offset to set.
     * @param mixed $value  Value to set.
     * @return void
     */
    public function offsetSet($offset, $value) {
        $this->set($offset, $value);
    }

    /**
     * @param mixed $offset Offset to unset.
     * @return void
     */
    public function offsetUnset($offset) {
        $this->unset($offset);
    }

    /**
     * Get the value of a given key.
     * If the key does not exist, a InvalidArgumentException will be thrown.
     *
     * @param string $key Key to fetch.
     * @return mixed
     * @throws InvalidArgumentException On out of bounds error. Deprecated and will change to OutOfBoundsException in next major release.
     */
    public function get(string $key) {
        if (!$this->has($key)) {
            throw new InvalidArgumentException(
                sprintf('Key "%s" does not exist.', $key)
            );
        }

        return $this->innerMap[$key];
    }

    /**
     * Set a given keys value.
     * If the key already exists a InvalidArgumentException will be thrown.
     *
     * @param string $key   Key to set.
     * @param mixed  $value Object to add.
     * @return boolean
     * @throws InvalidArgumentException On out of bounds error. Deprecated and will change to OutOfBoundsException in next major release.
     */
    public function add(string $key, $value): bool {
        if ($this->has($key)) {
            throw new InvalidArgumentException(
                sprintf('Key "%s" already exist.', $key)
            );
        }

        $this->innerMap[$key] = $value;
        $this->count++;
        return true;
    }

    /**
     * Sets a value to a key.
     * This function can be used safely to add/set values without raising exceptions.
     * If the key already exist the value will be replaced with passed value.
     *
     * @param string $key   Key to set.
     * @param mixed  $value Value to set.
     * @return boolean
     */
    public function set(string $key, $value): bool {
        $this->innerMap[$key] = $value;
        $this->count          = count($this->innerMap);
        return true;
    }

    /**
     * Check if a key exists in the map.
     *
     * @param string $key Key to check for.
     * @return boolean
     */
    public function has(string $key): bool {
        return array_key_exists($key, $this->innerMap);
    }

    /**
     * Converts the map to a associative php array.
     *
     * @return array
     */
    public function toAssocArray(): array {
        return $this->innerMap;
    }

    /**
     * Fetches all keys as a indexed list.
     *
     * @return IndexedListInterface|string[]
     */
    public function keys(): IndexedListInterface {
        return new IndexedList(array_keys($this->innerMap));
    }

    /**
     * Fetches all values as a indexed list.
     *
     * @return IndexedListInterface|mixed[]
     */
    public function values(): IndexedListInterface {
        return new IndexedList(array_values($this->innerMap));
    }

    /**
     * Removes a given key-value pair.
     *
     * @param string $key Key to unset.
     * @return boolean
     */
    public function unset(string $key): bool {
        unset($this->innerMap[$key]);
        $result = !$this->has($key);
        if ($result) {
            $this->count--;
        }
        return $result;
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator() {
        return new ArrayIterator($this->innerMap);
    }

}
