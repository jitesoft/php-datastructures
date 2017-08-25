<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayQueue.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Queues;

use Jitesoft\Utilities\DataStructures\Contracts\QueueInterface;
use Jitesoft\Utilities\DataStructures\StaticArrayMethods;

/**
 * Class ArrayQueue
 *
 * A Queue (FiFo) structure using an array as base.
 */
class ArrayQueue implements QueueInterface {

    /** @var int */
    private $count;
    /** @var array */
    private $inner;

    /**
     * ArrayQueue constructor.
     */
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
        $this->inner = [];
        $this->count = 0;
        return true;
    }

    /**
     * Adds one or multiple objects to the end of the queue.
     *
     * @param $object - One or multiple objects to enqueue.
     * @return bool
     */
    public function enqueue(...$object): bool {
        foreach ($object as $o) {
            $this->inner[] = $o;
        }
        $this->count += count($object);
        return true;
    }

    /**
     * Returns the first object and removes it from the queue.
     *
     * @return mixed
     */
    public function dequeue() {
        if ($this->count === 0) {
            return null;
        }

        $element = array_splice($this->inner, 0, 1);
        $this->count--;
        return StaticArrayMethods::first($element);
    }

    /**
     * Returns the first object without removing it from the queue.
     *
     * @return mixed
     */
    public function peek() {
        return $this->count === 0 ? null : $this->inner[0];
    }
}
