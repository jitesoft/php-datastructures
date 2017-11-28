<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  MapInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Maps;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\CollectionInterface;
use Jitesoft\Utilities\DataStructures\Lists\IndexedListInterface;
use ArrayAccess;

interface MapInterface extends CollectionInterface, ArrayAccess {

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
     * @param string $key
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get(string $key);

    /**
     * Set a given keys value.
     * If the key already exists, it will be overwritten.
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function add(string $key, $value): bool;

    /**
     * Check if a key exists in the map.
     *
     * @param string $key
     * @return bool
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
     * @param string $key
     * @return bool
     */
    public function unset(string $key): bool;

}
