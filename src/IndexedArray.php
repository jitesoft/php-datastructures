<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  IndexedArray.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays;

use Jitesoft\Utilities\Arrays\Contracts\ListInterface;
use Traversable;

class IndexedArray implements ListInterface {

    private $innerArray = [];

    /**
     * ListInterface constructor.
     * @param array $from
     */
    public function __construct(array $from = []) {
    }

    /**
     * Add a object to the list.
     *
     * @param $object
     * @return bool
     */
    public function add($object): bool {
        // TODO: Implement add() method.
    }

    /**
     * Remove a object from the list.
     *
     * @param $object
     * @return bool
     */
    public function remove($object): bool {
        // TODO: Implement remove() method.
    }

    /**
     * Add objects to the list.
     *
     * @param array $objects
     * @return bool
     */
    public function addAll(array $objects): bool {
        // TODO: Implement addAll() method.
    }

    /**
     * Get number of objects in the list.
     *
     * @return int
     */
    public function length(): int {
        // TODO: Implement length() method.
    }

    /**
     * Get number of objects in the list.
     *
     * @return int
     */
    public function count(): int {
        // TODO: Implement count() method.
    }

    /**
     * Clear the list of all objects.
     *
     * @return bool
     */
    public function clear(): bool {
        // TODO: Implement clear() method.
    }










    //region Traversable, ArrayAccess.

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator() {
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

    //endregion
}
