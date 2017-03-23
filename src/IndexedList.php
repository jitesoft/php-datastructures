<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  IndexedList.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures;

use ArrayAccess;
use InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Contracts\IndexedListInterface;
use Jitesoft\Utilities\DataStructures\Traits\ArrayMethodsTrait;
use OutOfBoundsException;

class IndexedList implements IndexedListInterface {
    use ArrayMethodsTrait;

    private $innerArray = [];
    private $count      = 0;

    /**
     * ListInterface constructor.
     * @param array $from
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
     * @param $object
     * @return bool
     */
    public function add($object): bool {
        $this->innerArray[] = $object;
        $this->count++;
        return true;
    }

    /**
     * Remove a object from the list.
     *
     * @param $object
     * @return bool
     */
    public function remove($object): bool {
        if (!in_array($object, $this->innerArray)) {
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
     * @alias count()
     * @return int
     */
    public function length(): int {
        return $this->count;
    }


    /**
     * Get number of objects in the list.
     *
     * @alias count()
     * @return int
     */
    public function size(): int {
        return $this->count;
    }

    /**
     * Get number of objects in the list.
     *
     * @return int
     */
    public function count(): int {
        return $this->count;
    }

    /**
     * Clear the list of all objects.
     *
     * @return bool
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
     * @param $object
     * @param int $index
     * @return bool
     */
    public function insert($object, int $index): bool {
        $this->boundsCheck($index, $this->count+1, 0);

        $temp = [];
        for ($i=0;$i<$this->count;$i++) {
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
     * @param int $index
     * @param bool $cyclic If true, the array will move all objects after the removed object to keep the array order.
     *                      If false, the last index will be placed at the removed objects index to speed up the
     *                      execution.
     * @return bool
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
            if ($index !== $this->count -1) {
                $this->innerArray[$index] = $this->innerArray[$this->count-1];
            }
            unset($this->innerArray[$this->count-1]);
        }

        $this->count--;
        return true;
    }

    /**
     * Add a range of objects to the list.
     *
     * @param array|ArrayAccess $range
     * @return bool
     */
    public function addRange(array $range): bool {
        foreach ($range as $obj) {
            $this->innerArray[] = $obj;
        }
        $this->count += count($range);
        return true;
    }

    /**
     * Insert a range of objects into the List.
     *
     * @param array|ArrayAccess $range
     * @param int $index
     * @return bool
     */
    public function insertRange($range, int $index): bool {
        $temp = [];
        for ($i=0;$i<$this->count;$i++) {
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

    //region ArrayAccess.

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
        return isset($this->innerArray[$offset]);
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
        $this->boundsCheck($offset, $this->count(), 0);
        return $this->innerArray[$offset];
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
        $this->boundsCheck($offset, $this->count()+1, 0);
        if (!isset($this->innerArray[$offset])) {
            $this->count++;
        }

        $this->innerArray[$offset] = $value;
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
        $this->removeAt($offset, true);
    }

    //endregion

    private function boundsCheck($offset, int $high, int $low = 0) {
        if (!is_integer($offset)) {
            throw new InvalidArgumentException("Invalid indexer access. Argument was not of integer type.");
        }

        if ($offset > $high || $offset < $low) {
            throw new OutOfBoundsException("Array out of bounds.");
        }
    }
}
