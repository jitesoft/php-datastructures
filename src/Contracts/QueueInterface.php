<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  QueueInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Contracts;

/**
 * Interface for FiFo queues.
 */
interface QueueInterface extends ListInterface {

    /**
     * Adds one or multiple objects to the end of the queue.
     *
     * @param $object - One or multiple objects to enqueue.
     * @return bool
     */
    public function enqueue(...$object): bool;

    /**
     * Returns the first object and removes it from the queue.
     *
     * @return mixed
     */
    public function dequeue();

    /**
     * Returns the first object without removing it from the queue.
     *
     * @return mixed
     */
    public function peek();
}
