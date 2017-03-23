<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  StackInterface.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays\Contracts;

/**
 * Interface for LiFo stacks.
 */
interface StackInterface extends ListInterface {

    /**
     * Adds a object to the top of the stack.
     *
     * @param $object
     * @return bool
     */
    public function push($object): bool;

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
