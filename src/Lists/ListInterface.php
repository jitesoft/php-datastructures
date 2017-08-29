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
     * @param array $from
     */
    public function __construct(array $from = []);
}
