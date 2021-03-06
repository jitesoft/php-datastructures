<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayQueue.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Queues;

use Jitesoft\Utilities\DataStructures\Arrays;

/**
 * Class ArrayQueue
 *
 * A Queue (FiFo) structure using an array as base.
 */
class ArrayQueue implements QueueInterface {
    private int $count;
    private array $inner;

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
     * @alias count()
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
        $this->inner = [];
        $this->count = 0;
        return true;
    }

    /**
     * Adds one or multiple objects to the end of the queue.
     *
     * @param array|mixed ...$object One or multiple objects to enqueue.
     * @return boolean
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
        return Arrays::first($element);
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
