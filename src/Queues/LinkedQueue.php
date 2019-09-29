<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  LinkedQueue.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Queues;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Internal\Node;

/**
 * Class LinkedQueue
 *
 * A Queue (FiFo) structure built as a linked list.
 */
class LinkedQueue implements QueueInterface {
    /** @var integer */
    private $count;
    /** @var null|Node */
    private $first;
    /** @var null|Node */
    private $last;

    /**
     * LinkedQueue constructor.
     */
    public function __construct() {
        $this->first = null;
        $this->last  = null;
        $this->count = 0;
    }

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
        $this->first = null;
        $this->last  = null;
        $this->count = 0;
        return true;
    }

    /**
     * Adds one or multiple objects to the end of the queue.
     *
     * @param array|mixed ...$object One or multiple objects to enqueue.
     * @return boolean
     * @throws InvalidArgumentException Should not happen. Exception is deprecated and will not be thrown in future versions.
     */
    public function enqueue(...$object): bool {
        if ($this->first === null) {
            $this->first = new Node($object[0], 1);
            $this->last  = $this->first;
            array_splice($object, 0, 1);
            $this->count++;
        }

        foreach ($object as $o) {
            $node = new Node($o, 1);

            $this->last->setLink(0, $node);
            $this->last = $this->last->getLink(0);
        }

        $this->count += count($object);
        return true;
    }

    /**
     * Returns the first object and removes it from the queue.
     *
     * @return mixed
     * @throws InvalidArgumentException Should not happen. Exception is deprecated and will not be thrown in future versions.
     */
    public function dequeue() {
        if ($this->count <= 0) {
            return null;
        }

        $old         = $this->first;
        $this->first = $this->first->getLink(0);
        $value       = $old->getItem();
        $old->setLink(0, null);

        $this->count--;

        return $value;
    }

    /**
     * Returns the first object without removing it from the queue.
     *
     * @return mixed
     */
    public function peek() {
        if ($this->count === 0) {
            return null;
        }

        return $this->first->getItem();
    }

}
