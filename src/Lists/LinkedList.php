<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  LinkedList.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Lists;

use ArrayAccess;
use InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Contracts\IndexedListInterface;
use Jitesoft\Utilities\DataStructures\Internal\Node;
use Jitesoft\Utilities\DataStructures\Traits\ArrayMethodsTrait;
use OutOfBoundsException;

class LinkedList implements IndexedListInterface {
    use ArrayMethodsTrait;

    /** @var Node|null */
    private $rootNode = null;
    /** @var Node|null */
    private $lastNode = null;
    /** @var int */
    private $count = 0;

    //region ArrayAccess
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
        if (!is_integer($offset) || ($offset > $this->count-1 || $offset < 0)) {
            return false;
        }

        return true;
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
        $this->boundsCheck($offset, $this->count, 0);
        return $this->getNode($offset)->getItem();
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
        $this->boundsCheck($offset, $this->count+1, 0);
        $this->insert($value, $offset);
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

    /**
     * Add a object to the list.
     *
     * @param $object
     * @return bool
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
     * @param $object
     * @return bool
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



        $this->lastNode = $remove->getLink(0) === null ? $prev : $this->lastNode;
        $this->count--;
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
        if ($index === $this->count) {
            return $this->add($object);
        }
        $this->boundsCheck($index, $this->count, 0);

        $node = $this->getOrCreateRoot(null);

        for ($i=$index-1;$i-->0;) {
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
     * @param int $index
     * @param bool $cyclic [always true].
     * @return bool
     */
    public function removeAt(int $index, bool $cyclic = true): bool {
        $this->boundsCheck($index, $this->count, 0);

        $toRemove = $this->rootNode;
        $node     = null;

        if ($index !== 0) {
            $node     = $this->getNode($index-1);
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
     * @param array|ArrayAccess $range
     * @param int $index
     * @return bool
     */
    public function insertRange($range, int $index): bool {
        if ($this->count === $index) {
            return $this->addRange($range);
        }
        $this->boundsCheck($index, $this->count, 0);
        $node = $this->getOrCreateRoot(null);

        for ($i=$index-1;$i-->0;) {
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
     * @param array $range
     * @return bool
     */
    public function addRange(array $range): bool {
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
     * @param array $from
     */
    public function __construct(array $from = []) {
        if (count($from) > 0) {
            $this->addRange($from);
        }
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
     * @return int
     */
    public function count(): int {
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
     * Clear the list of all objects.
     *
     * @return bool
     */
    public function clear(): bool {
        $this->rootNode = null;
        $this->lastNode = null;
        $this->count = 0;
        return true;
    }

    /**
     * @param int $offset
     * @param int $high
     * @param int $low
     */
    private function boundsCheck($offset, int $high, int $low = 0) {
        if (!is_integer($offset)) {
            throw new InvalidArgumentException("Invalid indexer access. Argument was not of integer type.");
        }

        if ($offset > $high || $offset < $low) {
            throw new OutOfBoundsException("Array out of bounds.");
        }
    }

    /**
     * @param mixed $value
     * @return Node
     */
    private function getOrCreateRoot($value) {
        if ($this->rootNode === null) {
            $this->rootNode = new Node($value, 1);
            $this->lastNode = $this->rootNode;
        }

        return $this->rootNode;
    }

    private function getNode($index) {
        $node = $this->rootNode;
        for ($i=$index;$i-->0;) {
            $node = $node->getLink(0);
        }
        return $node;
    }
}
