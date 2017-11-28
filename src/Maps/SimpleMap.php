<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  SimpleMap.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Maps;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Lists\IndexedList;
use Jitesoft\Utilities\DataStructures\Lists\IndexedListInterface;
use Jitesoft\Utilities\DataStructures\Traits\MapMethodsTrait;

class SimpleMap implements MapInterface {
    use MapMethodsTrait;

    /** @var array */
    private $innerMap;
    /** @var int */
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
     * @alias count()
     * @return int
     */
    public function length(): int {
        return $this->count();
    }

    /**
     * Get number of objects in the collection.
     *
     * @return int
     */
    public function count(): int {
        return $this->count;
    }

    /**
     * Get number of objects in the collection.
     *
     * @alias count()
     * @return int
     */
    public function size(): int {
        return $this->count();
    }

    /**
     * Clear the collection of all objects.
     *
     * @return bool
     */
    public function clear(): bool {
        $this->count    = 0;
        $this->innerMap = [];
        return true;
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
        return $this->has($offset);
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
        return $this->get($offset);
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
        $this->set($offset, $value);
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
        $this->unset($offset);
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
     * @param string $key
     * @param mixed $value
     * @return bool
     * @throws InvalidArgumentException
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
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function set(string $key, $value): bool {
        $this->innerMap[$key] = $value;
        $this->count          = count($this->innerMap);
        return true;
    }

    /**
     * Check if a key exists in the map.
     *
     * @param string $key
     * @return bool
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
     * @param string $key
     * @return bool
     */
    public function unset(string $key): bool {
        unset($this->innerMap[$key]);
        $result =  !$this->has($key);
        if ($result) {
            $this->count--;
        }
        return $result;
    }
}
