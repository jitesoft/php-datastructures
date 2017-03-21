<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ListInterface.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays\Contracts;

use ArrayAccess;
use IteratorAggregate;
use Countable;

/**
 * Interface for all List classes.
 */
interface ListInterface extends ArrayAccess, IteratorAggregate, Countable {

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
