<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  AbstractSort.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Lists\Sorting;

use ArrayAccess;

/**
 * Baseclass for sorting classes.
 * The class forces a single function, sort, to be implemented.
 * It takes an array and a compare callable and expects an array to be returned sorted.
 */
abstract class AbstractSort {

    /**
     * Sort a given array by using the compare callable passed as second argument.
     *
     * @param array|ArrayAccess $array   Array to sort.
     * @param callable          $compare Comparator function.
     * @return array|ArrayAccess
     */
    abstract public static function sort($array, callable $compare);

}
