<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  MapInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Maps;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Exceptions\Logic\InvalidKeyException;
use Jitesoft\Utilities\DataStructures\CollectionInterface;
use Jitesoft\Utilities\DataStructures\Lists\IndexedListInterface;
use ArrayAccess;
use IteratorAggregate;

interface MapInterface extends CollectionInterface,
                               ArrayAccess,
                               IteratorAggregate {

    /**
     * MapInterface constructor.
     *
     * @param array|null $array Optional associative array to use as base.
     */
    public function __construct(?array $array = null);

    /**
     * Get the value of a given key.
     * If the key does not exist, a InvalidArgumentException will be thrown.
     *
     * @param string $key Key to fetch.
     * @return mixed
     * @throws InvalidKeyException Thrown if key does not exist.
     */
    public function get(string $key);

    /**
     * Set a given keys value.
     * If the key already exists a InvalidArgumentException will be thrown.
     *
     * @param string $key   Key to add.
     * @param mixed  $value Value to add.
     * @return boolean
     * @throws InvalidKeyException Thrown if key already exist.
     */
    public function add(string $key, $value): bool;

    // TODO: Add tryGet(..)

    /**
     * Sets a value to a key.
     * This function can be used safely to add/set values without raising exceptions.
     * If the key already exist the value will be replaced with passed value.
     *
     * @param string $key   Key to set.
     * @param mixed  $value Value to set.
     * @return boolean
     */
    public function set(string $key, $value): bool;

    /**
     * Check if a key exists in the map.
     *
     * @param string $key Key to check for.
     * @return boolean
     */
    public function has(string $key): bool;

    /**
     * Converts the map to a associative php array.
     *
     * @return array
     */
    public function toAssocArray(): array;

    /**
     * Fetches all keys as a indexed list.
     *
     * @return IndexedListInterface|string[]
     */
    public function keys(): IndexedListInterface;

    /**
     * Fetches all values as a indexed list.
     *
     * @return IndexedListInterface|mixed[]
     */
    public function values(): IndexedListInterface;

    /**
     * Removes a given key-value pair.
     *
     * @param string $key Key to unset.
     * @return boolean
     */
    public function unset(string $key): bool;

}
