<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ListInterface.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays\Contracts;

use ArrayAccess;
use IteratorAggregate;

/**
 * Interface for List classes.
 */
interface ListInterface extends ArrayAccess, IteratorAggregate {

    /**
     * ListInterface constructor.
     * @param array $from
     */
    public function __construct(array $from = []);


    /**
     * Add objects to the list.
     *
     * @param array $objects
     * @return bool
     */
    public function addAll(array $objects): bool;

    /**
     * Get number of objects in the list.
     *
     * @return int
     */
    public function length(): int;

    /**
     * Get number of objects in the list.
     *
     * @return int
     */
    public function count(): int ;

    /**
     * Clear the list of all objects.
     *
     * @return bool
     */
    public function clear(): bool;
}
