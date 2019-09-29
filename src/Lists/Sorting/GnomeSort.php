<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  GnomeSort.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Lists\Sorting;

use ArrayAccess;

/**
 * Class GnomeSort
 *
 * Sort implementation using the GnomeSort algorithm.
 */
final class GnomeSort extends AbstractSort {

    /**
     * Sort a given array by using the compare callable passed as second argument.
     *
     * @param array|ArrayAccess $array   Array to sort.
     * @param callable          $compare Comparator function.
     * @return array|ArrayAccess
     */
    public static function sort($array, callable $compare) {
        $c = count($array);
        $i = 0;

        while ($i < $c) {

            if ($i === 0 || $compare($array[$i - 1], $array[$i]) <= 0) {
                $i++;
            } else {
                $tmp         = $array[$i];
                $array[$i]   = $array[$i - 1];
                $array[--$i] = $tmp;
            }
        }

        return $array;
    }

}
