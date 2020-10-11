<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  IndexedList.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Lists;

use ArrayAccess;
use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Traits\ArrayMethodsTrait;
use Jitesoft\Exceptions\Logic\OutOfBoundsException;

/**
 * Class IndexedList
 *
 * A Indexed list structure using an array as base.
 * This class is sort of like a wrapper for the array structure to enable
 * easier access to methods that are made for lists.
 */
class IndexedList implements IndexedListInterface {
    use ArrayMethodsTrait;

    private array $innerArray = [];
    private int $count;

    /**
     * ListInterface constructor.
     * @param array $from Array to create list from.
     */
    public function __construct(array $from = []) {
        foreach ($from as $item) {
            $this->innerArray[] = $item;
        }
        $this->count = count($from);
    }

    /**
     * Add a object to the list.
     *
     * @param mixed $object Object to add.
     * @return boolean
     */
    public function add($object): bool {
        $this->innerArray[] = $object;
        $this->count++;
        return true;
    }

    /**
     * Remove a object from the list.
     *
     * @param mixed $object Object to remove.
     * @return boolean
     */
    public function remove($object): bool {
        if (!in_array($object, $this->innerArray, true)) {
            return false;
        }

        $temp = [];
        foreach ($this->innerArray as $item) {
            if ($item === $object) {
                continue;
            }

            $temp[] = $item;
        }

        $this->innerArray = $temp;
        $this->count--;
        return true;
    }

    /**
     * Get number of objects in the list.
     *
     * @alias count
     * @return integer
     */
    public function length(): int {
        return $this->count;
    }

    /**
     * Get number of objects in the list.
     *
     * @alias count
     * @return integer
     */
    public function size(): int {
        return $this->count;
    }

    /**
     * Get number of objects in the list.
     *
     * @return integer
     */
    public function count(): int {
        return $this->count;
    }

    /**
     * Clear the list of all objects.
     *
     * @return boolean
     */
    public function clear(): bool {
        unset($this->innerArray);
        $this->innerArray = [];
        $this->count      = 0;
        return true;
    }

    /**
     * Insert a object at the specific location.
     *
     * @param mixed   $object Object to insert.
     * @param integer $index  Index to insert at.
     * @return boolean
     * @throws OutOfBoundsException On out-of-bounds error.
     */
    public function insert($object, int $index): bool {
        $this->boundsCheck($index, $this->count + 1, 0);

        $temp = [];
        for ($i = 0;$i < $this->count;$i++) {
            if ($i === $index) {
                $temp[] = $object;
            }
            $temp[] = $this->innerArray[$i];
        }
        $this->innerArray = $temp;
        $this->count++;
        return true;
    }

    /**
     * Remove a object at a specific location.
     *
     * @param integer $index  Index to remove.
     * @param boolean $cyclic If true, the array will move all objects after the removed object to keep the array order.
     *                        If false, the last index will be placed at the removed objects index to speed up the
     *                        execution.
     * @return boolean
     * @throws InvalidArgumentException Deprecated exception.
     * @throws OutOfBoundsException     In case index is out of bounds.
     */
    public function removeAt(int $index, bool $cyclic = false): bool {
        $this->boundsCheck($index, $this->count, 0);

        if ($cyclic) {
            $temporary = [];
            $counter   = 0;
            foreach ($this->innerArray as $object) {
                if ($counter === $index) {
                    $counter++;
                    continue;
                }

                $temporary[] = $object;
                $counter++;
            }
            $this->innerArray = $temporary;
        } else {
            if ($index !== $this->count - 1) {
                $this->innerArray[$index] = $this->innerArray[$this->count - 1];
            }
            unset($this->innerArray[$this->count - 1]);
        }

        $this->count--;
        return true;
    }

    /**
     * Add a range of objects to the list.
     *
     * @param array|ArrayAccess $range Range to add.
     * @return boolean
     */
    public function addRange($range): bool {
        foreach ($range as $obj) {
            $this->innerArray[] = $obj;
        }
        $this->count += count($range);
        return true;
    }

    /**
     * Insert a range of objects into the List.
     *
     * @param array|ArrayAccess $range Range to add.
     * @param integer           $index Index to start insertion at.
     * @return boolean
     */
    public function insertRange($range, int $index): bool {
        $temp = [];
        for ($i = 0;$i < $this->count;$i++) {
            if ($i === $index) {
                foreach ($range as $o) {
                    $temp[] = $o;
                }
            }
            $temp[] = $this->innerArray[$i];
        }
        $this->count     += count($range);
        $this->innerArray = $temp;
        return true;
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset An offset to check for.
     * @return boolean true on success or false on failure.
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset): bool {
        return isset($this->innerArray[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset The offset to retrieve.
     * @return mixed Can return all value types.
     * @throws InvalidArgumentException Deprecated exception.
     * @throws OutOfBoundsException     If index is out of bounds.
     */
    public function offsetGet($offset) {
        $this->boundsCheck($offset, $this->count(), 0);
        return $this->innerArray[$offset];
    }

    /**
     * Offset to set
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value  The value to set.
     * @return void
     * @throws InvalidArgumentException Deprecated exception.
     * @throws OutOfBoundsException     If index is out of bounds.
     */
    public function offsetSet($offset, $value): void {
        $this->boundsCheck($offset, $this->count() + 1, 0);
        if (!isset($this->innerArray[$offset])) {
            $this->count++;
        }

        $this->innerArray[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset The offset to unset.
     * @return void
     * @throws InvalidArgumentException Deprecated exception.
     * @throws OutOfBoundsException     If index is out of range.
     */
    public function offsetUnset($offset): void {
        $this->removeAt($offset, true);
    }

    /**
     * Utility method to ease bounds checking.
     *
     * @param integer $offset Offset to check.
     * @param integer $high   High limit.
     * @param integer $low    Low limit.
     * @throws OutOfBoundsException     In case offset is out of range.
     * @return void
     */
    private function boundsCheck(int $offset, int $high, int $low = 0): void {
        if ($offset > $high || $offset < $low) {
            throw new OutOfBoundsException('Array out of bounds.');
        }
    }

    /**
     * Convert the list object into a native php array.
     *
     * @return array
     */
    public function toArray(): array {
        return $this->innerArray;
    }

}
