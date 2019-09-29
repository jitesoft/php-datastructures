<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  LinkedList.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Lists;

use ArrayAccess;
use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Internal\Node;
use Jitesoft\Utilities\DataStructures\Traits\ArrayMethodsTrait;
use Jitesoft\Exceptions\Logic\OutOfBoundsException;

/**
 * Class LinkedList
 *
 * A List structure using a list of linked nodes.
 */
class LinkedList implements IndexedListInterface {
    use ArrayMethodsTrait;

    /** @var Node|null */
    private $rootNode = null;
    /** @var Node|null */
    private $lastNode = null;
    /** @var integer */
    private $count = 0;

    /**
     * Whether a offset exists
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset An offset to check for.
     * @return boolean true on success or false on failure. The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset) {
        return is_integer($offset) &&
            ($offset < $this->count - 1 && $offset > 0);
    }

    /**
     * Offset to retrieve
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset The offset to retrieve.
     * @return mixed Can return all value types.
     * @throws InvalidArgumentException In case of invalid key.
     * @throws OutOfBoundsException     If key is out of bounds, i.e., does not exist.
     * @since 5.0.0
     */
    public function offsetGet($offset) {
        $this->boundsCheck($offset, $this->count, 0);
        return $this->getNode($offset)->getItem();
    }

    /**
     * Offset to set
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value  The value to set.
     * @return void
     * @throws InvalidArgumentException In case of invalid key.
     * @throws OutOfBoundsException     If key is out of bounds, i.e., does not exist.
     * @since 5.0.0
     */
    public function offsetSet($offset, $value) {
        $this->boundsCheck($offset, $this->count + 1, 0);
        $this->insert($value, $offset);
    }

    /**
     * Offset to unset
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset The offset to unset.
     * @return void
     * @throws InvalidArgumentException In case of invalid key.
     * @throws OutOfBoundsException     If key is out of bounds, i.e., does not exist.
     * @since 5.0.0
     */
    public function offsetUnset($offset) {
        $this->removeAt($offset, true);
    }

    /**
     * Add a object to the list.
     *
     * @param mixed $object Object to add.
     * @return boolean
     * @throws InvalidArgumentException On out of bounds - Deprecated and will be using OutOfBoundsException in next major release.
     */
    public function add($object): bool {
        if ($this->lastNode === null) {
            $this->getOrCreateRoot($object);
            $this->count++;
            return true;
        }

        $this->lastNode->setLink(0, new Node($object, 1));
        $this->lastNode = $this->lastNode->getLink(0);
        $this->count++;
        return true;
    }

    /**
     * Remove a object from the list.
     *
     * @param mixed $object Object to remove.
     * @return boolean
     * @throws InvalidArgumentException On out of bounds - Deprecated and will be using OutOfBoundsException in next major release.
     */
    public function remove($object): bool {
        if ($this->count === 0) {
            return false;
        }

        if ($this->count === 1) {
            if ($this->rootNode->getItem() === $object) {
                return $this->clear();
            }
            return false;
        }

        $remove = $this->rootNode;
        $prev   = null;
        while ($remove !== null) {
            if ($remove->getItem() === $object) {
                break;
            }
            $prev   = $remove;
            $remove = $remove->getLink(0);
        }

        if ($prev === null) { // Is first.
            $old            = $this->rootNode;
            $this->rootNode = $remove->getLink(0);
            $old->setLink(0, null);
        } else {
            $prev->setLink(0, $remove->getLink(0));
            $remove->setLink(0, null);
        }

        $this->lastNode = !$remove->getLink(0) ? $prev : $this->lastNode;
        $this->count--;
        return true;
    }

    /**
     * Insert a object at the specific location.
     *
     * @param mixed   $object Object to insert.
     * @param integer $index  Index to insert object at.
     * @return boolean
     * @throws InvalidArgumentException On invalid object.
     * @throws OutOfBoundsException     If index is out of bounds.
     */
    public function insert($object, int $index): bool {
        if ($index === $this->count) {
            return $this->add($object);
        }
        $this->boundsCheck($index, $this->count, 0);

        $node = $this->getOrCreateRoot(null);

        for ($i = $index - 1; $i-- > 0;) {
            $node = $node->getLink(0);
        }

        $child  = $node;
        $parent = $node->getLink(0);
        $new    = new Node($object, 1);

        $child->setLink(0, $new);
        $new->setLink(0, $parent);
        $this->count++;

        return true;
    }

    /**
     * Remove a object at a specific location.
     *
     * @param integer $index  Index to remove.
     * @param boolean $cyclic If to use a cyclic removal, iterating all objects down the list.
     * @return boolean
     * @throws InvalidArgumentException On invalid object.
     * @throws OutOfBoundsException     If index is out of bounds.
     */
    public function removeAt(int $index, bool $cyclic = true): bool {
        $this->boundsCheck($index, $this->count, 0);

        $toRemove = $this->rootNode;
        $node     = null;

        if ($index !== 0) {
            $node     = $this->getNode($index - 1);
            $toRemove = $node->getLink(0);
        }

        $replace = $toRemove->getLink(0);

        if (!$cyclic && $replace !== $this->lastNode) {
            $replace        = $this->lastNode;
            $this->lastNode = $this->getNode($this->count - 2);
            $this->lastNode->setLink(0, null);
            $replace->setLink(0, $toRemove->getLink(0));
        }

        if ($node !== null) {
            $node->setLink(0, $replace);
        } else {
            $this->rootNode = $replace;
        }
        $toRemove->setLink(0, null);
        $this->count--;
        return true;
    }

    /**
     * Insert a range of objects into the List.
     *
     * @param array|ArrayAccess $range Objects to add.
     * @param integer           $index Index to start insertion at.
     * @return boolean
     * @throws InvalidArgumentException On invalid object.
     * @throws OutOfBoundsException     If index is out of bounds.
     */
    public function insertRange($range, int $index): bool {
        if ($this->count === $index) {
            return $this->addRange($range);
        }
        $this->boundsCheck($index, $this->count, 0);
        $node = $this->getOrCreateRoot(null);

        for ($i = $index - 1; $i-- > 0;) {
            $node = $node->getLink(0);
        }
        $child = $node->getLink(0);

        foreach ($range as $obj) {
            $node->setLink(0, new Node($obj, 1));
            $node = $node->getLink(0);
        }

        $node->setLink(0, $child);

        $this->count += count($range);
        return true;
    }

    /**
     * Add objects to the list.
     *
     * @param array|ArrayAccess $range Range to add.
     * @return boolean
     * @throws InvalidArgumentException Deprecated exception. Should never happen.
     */
    public function addRange($range): bool {
        if ($this->rootNode === null) {
            $this->getOrCreateRoot($range[0]);
            array_splice($range, 0, 1);
            $this->count++;
        }

        foreach ($range as $object) {
            $this->lastNode->setLink(0, new Node($object, 1));
            $this->lastNode = $this->lastNode->getLink(0);
        }

        $this->count += count($range);
        return true;
    }

    /**
     * ListInterface constructor.
     *
     * @param array $from Array to create list from.
     * @throws InvalidArgumentException Deprecated exception. Should never happen.
     */
    public function __construct(array $from = []) {
        if (!empty($from)) {
            $this->addRange($from);
        }
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
     * @return integer
     */
    public function count(): int {
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
     * Clear the list of all objects.
     *
     * @return boolean
     */
    public function clear(): bool {
        $this->rootNode = null;
        $this->lastNode = null;
        $this->count    = 0;
        return true;
    }

    /**
     * Util method to easier do bounds checks.
     *
     * @param integer $offset Offset to check.
     * @param integer $high   Highest bound.
     * @param integer $low    Lowest bound.
     * @throws InvalidArgumentException In case offset is not an integer.
     * @throws OutOfBoundsException     If index is out of bounds.
     * @return void
     */
    private function boundsCheck(int $offset, int $high, int $low = 0) {
        if (!is_integer($offset)) {
            throw new InvalidArgumentException(
                'Invalid indexer access. Argument was not of integer type.'
            );
        }

        if ($offset > $high || $offset < $low) {
            throw new OutOfBoundsException('Array out of bounds.');
        }
    }

    /**
     * @param mixed $value Value to add to the root.
     * @return Node
     */
    private function getOrCreateRoot($value) {
        if ($this->rootNode === null) {
            $this->rootNode = new Node($value, 1);
            $this->lastNode = $this->rootNode;
        }

        return $this->rootNode;
    }

    /**
     * @param integer $index Index to fetch.
     * @return Node|null
     * @throws InvalidArgumentException Deprecated exception.
     */
    private function getNode(int $index) {
        $node = $this->rootNode;
        for ($i = $index; $i-- > 0;) {
            $node = $node->getLink(0);
        }
        return $node;
    }

    /**
     * Convert the list object into a native php array.
     *
     * @return array
     * @throws InvalidArgumentException Deprecated exception.
     */
    public function toArray(): array {
        $out  = [];
        $node = $this->rootNode;
        while ($node !== null) {
            $out[] = $node->getItem();
            $node  = $node->getLink(0);
        }
        return $out;
    }

}
