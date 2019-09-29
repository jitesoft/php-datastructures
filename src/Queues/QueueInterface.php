<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  QueueInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Queues;

use Jitesoft\Utilities\DataStructures\CollectionInterface;

/**
 * Interface for FiFo queues.
 */
interface QueueInterface extends CollectionInterface {

    /**
     * Adds one or multiple objects to the end of the queue.
     *
     * @param array|mixed ...$object One or multiple objects to enqueue.
     * @return boolean
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
