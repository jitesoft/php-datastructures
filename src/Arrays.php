<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  StaticArrayMethods.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures;

use ArrayAccess;
use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Lists\Sorting\AbstractSort;
use Jitesoft\Utilities\DataStructures\Lists\Sorting\GnomeSort;
use Jitesoft\Utilities\DataStructures\Lists\Sorting\NativeSort;
use Jitesoft\Utilities\DataStructures\Lists\Sorting\QuickSort;
use Jitesoft\Exceptions\Lazy\NotImplementedException;


/**
 * Class Arrays
 *
 * A collection of static methods used on arrays, ArrayAccess or ListInterface objects.
 */
final class Arrays {

    public const GNOME_SORT  = GnomeSort::class;
    public const QUICK_SORT  = QuickSort::class;
    public const NATIVE_SORT = NativeSort::class;

    private function __construct() { }

    /**
     * @param mixed             $object - Object of the current Iteration.
     * @param integer           $index  - Index of the current iteration.
     * @param ArrayAccess|array $list   - The list which is being iterated.
     * @return mixed
     * @throws NotImplementedException
     * @codeCoverageIgnore
     */
    private static function callback($object, int $index, $list) {
        throw new NotImplementedException('...');
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
        for ($i = 0;$i < $count;$i++) {
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
        for ($i = 0;$i < $count;$i++) {
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
        for ($i = 0;$i < $count;$i++) {
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

        for ($i = 0;$i < $count;$i++) {
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

        for ($i = $count;$i-- > 0;) {
            if ($closure($array[$i], $i, $array)) {
                return $array[$i];
            }
        }
        return null;
    }

    /**
     * Sorts a given array using the provided comparator callable and sorting type.
     * The sort type needs to be a class name extending the
     *
     * @param $array
     * @param callable|null $compare
     * @param string        $sortType
     * @return array
     * @throws InvalidArgumentException
     */
    public static function sort($array, ?callable $compare = null, $sortType = self::NATIVE_SORT) {
        if (!is_subclass_of($sortType, AbstractSort::class)) {
            throw new InvalidArgumentException(
                sprintf('The argument for sortType (%s) does not derive from the AbstractSort class.', $sortType),
                '$sortType',
                'sort',
                'Arrays'
            );
        }

        if ($compare === null) {
            $compare = function($a, $b) {
                return $a - $b;
            };
        }

        /** @var $sortType AbstractSort */
        return $sortType::sort($array, $compare);
    }

}
