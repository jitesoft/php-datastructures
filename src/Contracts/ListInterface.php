<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ListInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Contracts;

use ArrayAccess;
use Countable;

/**
 * Interface for all List classes.
 */
interface ListInterface extends ArrayAccess, Countable {

    /**
     * ListInterface constructor.
     * @param array $from
     */
    public function __construct(array $from = []);

    /**
     * Get number of objects in the list.
     *
     * @alias count()
     * @return int
     */
    public function length(): int;

    /**
     * Get number of objects in the list.
     *
     * @return int
     */
    public function count(): int;

    /**
     * Get number of objects in the list.
     *
     * @alias count()
     * @return int
     */
    public function size(): int;

    /**
     * Clear the list of all objects.
     *
     * @return bool
     */
    public function clear(): bool;

}
