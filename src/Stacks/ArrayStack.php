<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayStack.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Stacks;

use Jitesoft\Utilities\DataStructures\Contracts\StackInterface;

/**
 * Class ArrayStack
 *
 * A Stack (LiFo) structure using an array as underlying structure.
 */
class ArrayStack implements StackInterface {

    /** @var array */
    private $inner;
    /** @var int */
    private $count;

    public function __construct() {
        $this->inner = [];
        $this->count = 0;
    }

    /**
     * Get number of objects in the collection.
     *
     * @alias count()
     * @return int
     */
    public function length(): int {
        return $this->count;
    }

    /**
     * Get number of objects in the collection.
     *
     * @return int
     */
    public function count(): int {
        return $this->count;
    }

    /**
     * Get number of objects in the collection.
     *
     * @alias count()
     * @return int
     */
    public function size(): int {
        return $this->count;
    }

    /**
     * Clear the collection of all objects.
     *
     * @return bool
     */
    public function clear(): bool {
        $this->count = 0;
        $this->inner = [];
        return true;
    }

    /**
     * Adds one or more object to the top of the stack.
     *
     * @param $objects
     * @return bool
     */
    public function push(...$objects): bool {
        foreach ($objects as $obj) {
            $this->inner[] = $obj;
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

        $element = array_pop($this->inner);
        $this->count--;
        return $element;
    }

    /**
     * Returns the object from top of stack without removing it.
     *
     * @return mixed
     */
    public function peek() {
        return $this->count === 0 ? null : $this->inner[$this->count-1];
    }
}
