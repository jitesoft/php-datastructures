<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ListInterface.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Lists;

use ArrayAccess;
use Jitesoft\Utilities\DataStructures\CollectionInterface;

/**
 * Base interface for all List classes.
 */
interface ListInterface extends CollectionInterface, ArrayAccess {

    /**
     * ListInterface constructor.
     * @param ArrayAccess|array $from
     */
    public function __construct($from = []);

    /**
     * Convert the list object into a native php array.
     *
     * @return array
     */
    public function toArray() : array;
}
