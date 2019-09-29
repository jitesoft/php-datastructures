<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  QuickSort.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Lists\Sorting;

use ArrayAccess;

/**
 * Class QuickSort
 *
 * Sort implementation using the QuickSort algorithm.
 */
final class QuickSort extends AbstractSort {

    /**
     * Sort a given array by using the compare callable passed as second argument.
     *
     * @param array|ArrayAccess $array   Array to sort.
     * @param callable          $compare Comparator function.
     * @return array|ArrayAccess
     */
    public static function sort($array, callable $compare) {
        $len = count($array);
        if ($len > 1) {

            $pivot      = $array[0];
            $partitions = [0 => [],1 => []];

            for ($i = $len;$i-- > 1;) {
                $partitions[ ($pivot > $array[$i]) ? 0 : 1 ][] = $array[$i];
            }

            return array_merge(
                self::sort(
                    $partitions[0], $compare
                ), [ $pivot ], self::sort($partitions[1], $compare)
            );
        }

        return $array;
    }

}
