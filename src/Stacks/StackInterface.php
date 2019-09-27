<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  StackInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Stacks;

use Jitesoft\Utilities\DataStructures\CollectionInterface;

/**
 * Interface for LiFo stacks.
 */
interface StackInterface extends CollectionInterface {

    /**
     * Adds one or more object to the top of the stack.
     *
     * @param $objects
     * @return boolean
     */
    public function push(...$objects): bool;

    /**
     * Removes and returns the object at the top of the stack.
     *
     * @return mixed
     */
    public function pop();

    /**
     * Returns the object from top of stack without removing it.
     *
     * @return mixed
     */
    public function peek();

}
