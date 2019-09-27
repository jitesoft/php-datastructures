<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  CollectionInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures;

use Countable;

/**
 * Base interface for collection data structures.
 */
interface CollectionInterface extends Countable {

    /**
     * Get number of objects in the collection.
     *
     * @alias count()
     * @return integer
     */
    public function length(): int;

    /**
     * Get number of objects in the collection.
     *
     * @return integer
     */
    public function count(): int;

    /**
     * Get number of objects in the collection.
     *
     * @alias count()
     * @return integer
     */
    public function size(): int;

    /**
     * Clear the collection of all objects.
     *
     * @return boolean
     */
    public function clear(): bool;

}
