<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  NativeSort.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Lists\Sorting;

use ArrayAccess;

/**
 * Class NativeSort
 *
 * Sort implementation using the native usort function.
 */
final class NativeSort extends AbstractSort {

    /**
     * Sort a given array by using the compare callable passed as second argument.
     *
     * @param array|ArrayAccess $array
     * @param callable          $compare
     * @return array|ArrayAccess
     */
    public static function sort($array, callable $compare) {
        usort($array, $compare);
        return $array;
    }

}
