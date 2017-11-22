<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  StaticArrayMethods.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures;

use ArrayAccess;
use Closure;
use Jitesoft\Exceptions\Lazy\NotImplementedException;


/**
 * Class Arrays
 *
 * A collection of static methods used on array or ArrayAccess objects.
 */
final class Arrays {
    private function __construct() { }

    /**
     * @param mixed $object - Object of the current Iteration.
     * @param int $index - Index of the current iteration.
     * @param ArrayAccess|array $list - The list which is being iterated.
     * @return mixed
     * @throws NotImplementedException
     * @codeCoverageIgnore
     */
    private static function callback($object, int $index, $list) {
        throw new NotImplementedException("...");
    }

    /**
     * Foreach method for a ListInterface implementation.
     *
     * Loops through each object in the List and applies the closure on it.
     * If closure returns false, it will stop the iteration and end the method, i.e, used as a break.
     *
     * @param ArrayAccess|array $array
     * @param callable          $closure {@see Arrays::callback()}
     */
    public static function forEach($array, callable $closure): void {
        $count = count($array);
        for ($i=0;$i<$count;$i++) {
            $result = $closure($array[$i], $i, $array);
            if ($result === false) {
                return;
            }
        }
    }

    /**
     * Method to iterate and apply a callback to each value in a ListInterface implementation.
     *
     * Loops through each object in the List and applies the closure on it.
     * Any value returned from the closure will end up in the result array returned when iteration is complete.
     *
     * @param ArrayAccess|array $array
     * @param callable          $closure {@see Arrays::callback()}
     * @return array
     */
    public static function map($array, callable $closure) {
        $result = [];
        $count  = count($array);
        for ($i=0;$i<$count;$i++) {
            $result[] = $closure($array[$i], $i, $array);
        }
        return $result;
    }

    /**
     * Filters a ArrayAccess implementation.
     *
     * Loops through each object in the List and applies the closure to it.
     * If closure returns true, the object will be added to the resulting array returned at the end of the iteration.
     * If closure returns false, the object will not be added.
     *
     * @param ArrayAccess|array $array
     * @param callable          $closure {@see Arrays::callback()}
     * @return array
     */
    public static function filter($array, callable $closure) {
        $result = [];
        $count  = count($array);
        for ($i=0;$i<$count;$i++) {
            if ($closure($array[$i], $i, $array) === true) {
                $result[] = $array[$i];
            }
        }
        return $result;
    }

    /**
     * Fetches first object on which the closure returns true.
     * If no closure is supplied, first object of the array will be returned.
     *
     * Depending on arguments the method will do the following:
     *
     * 1) With closure:
     * Loops through each object in the List and applies the closure to it.
     * If the closure returns true, the method will stop and return the value.
     * If the closure never returns false, null will be returned.
     *
     * 2) Without closure:
     * First object in the List will be returned.
     *
     * @param ArrayAccess|array $array
     * @param callable|null     $closure {@see Arrays::callback()}
     * @return mixed|null
     */
    public static function first($array, ?callable $closure = null) {
        $count = count($array);
        if ($closure === null && $count > 0) {
            return $array[0];
        }

        for ($i=0;$i<$count;$i++) {
            if ($closure($array[$i], $i, $array)) {
                return $array[$i];
            }
        }
        return null;
    }

    /**
     * Fetches last object on which the closure returns true.
     * If no closure is supplied, last object of the array will be returned.
     *
     * Depending on arguments the method will do the following:
     *
     * 1) With closure:
     * Loops through each object in the List and applies the closure to it.
     * If the closure returns true the last truthy value will be returned.
     * If the closure never returns true, null will be returned.
     *
     * 2) Without closure:
     * Last object in the List will be returned.
     *
     * @param ArrayAccess|array $array
     * @param callable|null     $closure $closure {@see Arrays::callback()}
     * @return mixed|null
     */
    public static function last($array, ?callable $closure = null) {
        $count = count($array);
        if ($closure === null && $count > 0) {
            return $array[$count - 1];
        }

        for ($i=$count;$i-->0;) {
            if ($closure($array[$i], $i, $array)) {
                return $array[$i];
            }
        }
        return null;
    }

}
