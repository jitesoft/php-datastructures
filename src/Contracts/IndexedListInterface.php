<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  IndexedListInterface.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays\Contracts;

use ArrayAccess;

interface IndexedListInterface {

    /**
     * Add a object to the list.
     *
     * @param $object
     * @return bool
     */
    public function add($object): bool;

    /**
     * Remove a object from the list.
     *
     * @param $object
     * @return bool
     */
    public function remove($object): bool;

    public function addAt($object, int $index): bool;

    /**
     * Remove a object at a specific location.
     *
     * @param int $index
     * @param bool $cyclic  If true, the array will move all objects after the removed object to keep the array order.
     *                      If false, the last index will be placed at the removed objects index to speed up the execution.
     * @return bool
     */
    public function removeAt(int $index, bool $cyclic = false): bool;

    /**
     * Add a range of objects to the list.
     *
     * @param ArrayAccess $range
     * @return bool
     */
    public function addRange(ArrayAccess $range): bool;

    /**
     * Insert a range of objects into the List.
     *
     * @param ArrayAccess $range
     * @param int $index
     * @return bool
     */
    public function insertRange(ArrayAccess $range, int $index): bool;
}
