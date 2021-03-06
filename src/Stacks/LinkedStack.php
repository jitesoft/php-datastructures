<?php
/** @noinspection PhpDocMissingThrowsInspection */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  LinkedStack.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Stacks;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Exceptions\Logic\OutOfBoundsException;
use Jitesoft\Utilities\DataStructures\Internal\Node;

/**
 * Class LinkedStack
 *
 * A Stack (LiFo) structure implemented as a linked list.
 */
class LinkedStack implements StackInterface {
    private ?Node $top    = null;
    private ?Node $bottom = null;
    private int $count    = 0;

    /**
     * Get number of objects in the collection.
     *
     * @alias count
     * @return integer
     */
    public function length(): int {
        return $this->count;
    }

    /**
     * Get number of objects in the collection.
     *
     * @return integer
     */
    public function count(): int {
        return $this->count;
    }

    /**
     * Get number of objects in the collection.
     *
     * @alias count
     * @return integer
     */
    public function size(): int {
        return $this->count;
    }

    /**
     * Clear the collection of all objects.
     *
     * @return boolean
     */
    public function clear(): bool {
        $this->bottom = null;
        $this->top    = null;
        $this->count  = 0;
        return true;
    }

    /**
     * Adds one or more object to the top of the stack.
     *
     * @param array|mixed ...$objects Objects to push to the stack.
     * @return boolean
     */
    public function push(...$objects): bool {
        if ($this->top === null) {
            $this->top    = new Node($objects[0], 1);
            $this->bottom = $this->top;
            array_splice($objects, 0, 1);
            $this->count++;
        }

        foreach ($objects as $object) {
            $node = new Node($object, 1);
            $node->setLink(0, $this->top);
            $this->top = $node;
        }
        $this->count += count($objects);
        return true;
    }

    /**
     * Removes and returns the object at the top of the stack.
     *
     * @return mixed
     */
    public function pop() {
        if ($this->count === 0) {
            return null;
        }

        $out       = $this->top;
        $this->top = $this->top->getLink(0);
        $out->setLink(0, null);
        $this->count--;
        return $out->getItem();
    }

    /**
     * Returns the object from top of stack without removing it.
     *
     * @return mixed
     */
    public function peek() {
        if ($this->count === 0) {
            return null;
        }

        return $this->top->getItem();
    }

}
