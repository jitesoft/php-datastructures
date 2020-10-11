<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Maps.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Exceptions\Lazy\NotImplementedException;
use Jitesoft\Utilities\DataStructures\Maps\MapInterface;

/**
 * Class Maps
 *
 * A collection of static methods to use on Map instances or associative arrays.
 */
final class Maps {

    /**
     * Maps constructor.
     */
    private function __construct() { }

//@codingStandardsIgnoreStart
    /**
     * @param mixed              $value Value of the current Iteration.
     * @param mixed              $key   Key of the current iteration.
     * @param MapInterface|array $list  The map which is being iterated.
     * @return mixed
     * @throws NotImplementedException This callback should not be used, hence it throws an exception.
     */
    private static function callback($value, $key, $list) {
        throw new NotImplementedException('...');
    }
// @codingStandardsIgnoreEnd

    /**
     * Foreach method for a MapInterface implementation.
     *
     * Loops through the Map and passes the value, key and Map to the action for each iteration.
     * If the action returns false, it will stop the loop, i.e., as a break.
     *
     * @param MapInterface|array $map    Map to run for-each on.
     * @param callable           $action Action to run on each item in the map.
     * @throws InvalidArgumentException In case the passed object is not a map.
     * @see Maps::callback()
     * @return void
     */
    public static function forEach($map, callable $action): void {
        if (!is_array($map) && !($map instanceof MapInterface)) {
            throw new InvalidArgumentException(
                'Passed argument was not a map.'
            );
        }

        foreach ($map as $key => $value) {
            if ($action($value, $key, $map) === false) {
                break;
            }
        }
    }

    /**
     * Method to iterate and apply a callback to each value in a MapInterface implementation.
     *
     * Loops through the Map and passes the value, key and Map to the action for each iteration.
     * Value returned from the method will be added to the returned map.
     *
     * @param MapInterface|array $map    Map to run `map` on.
     * @param callable           $action Action to invoke on each item in the map.
     * @throws InvalidArgumentException In case the passed object is not a map.
     * @return MapInterface|array
     * @see Maps::callback()
     */
    public static function map($map, callable $action) {
        if (!is_array($map) && !($map instanceof MapInterface)) {
            throw new InvalidArgumentException(
                'Passed argument was not a map.'
            );
        }

        $result = [];

        foreach ($map as $key => $value) {
            $result[$key] = $action($value, $key, $map);
        }

        if ($map instanceof MapInterface) {
            $class = get_class($map);
            return new $class($result);
        }
        return $result;
    }

    /**
     * Loops through the Map and applies the action to it.
     * If action returns true, the object will be added to the resulting map returned at the end of the iteration.
     *
     * @param MapInterface|array $map    Map to filter.
     * @param callable           $action Action to invoke on each item in the map to test for filtering.
     * @throws InvalidArgumentException In case the passed object is not a map.
     * @return MapInterface|array
     * @see Maps::callback()
     */
    public static function filter($map, callable $action) {
        if (!is_array($map) && !($map instanceof MapInterface)) {
            throw new InvalidArgumentException(
                'Passed argument was not a map.'
            );
        }

        $result = [];
        foreach ($map as $key => $value) {
            if ($action($value, $key, $map)) {
                $result[$key] = $value;
            }
        }

        if ($map instanceof MapInterface) {
            $class = get_class($map);
            return new $class($result);
        }
        return $result;
    }

    /**
     * Fetches the first value on which the action returns true.
     *
     * @param MapInterface|array $map    Map to fetch item from.
     * @param callable           $action Callable to use to test each item with.
     * @throws InvalidArgumentException In case passed object is not a map.
     * @return mixed
     * @see Maps::callback()
     */
    public static function first($map, callable $action) {
        if (!is_array($map) && !($map instanceof MapInterface)) {
            throw new InvalidArgumentException(
                'Passed argument was not a map.'
            );
        }

        foreach ($map as $key => $value) {
            if ($action($value, $key, $map)) {
                return $value;
            }
        }
        return null;
    }

    /**
     * Fetches the last value on which the action returns true.
     *
     * @param MapInterface|array $map    Map to fetch item from.
     * @param callable           $action Action to use to test each item with.
     * @throws InvalidArgumentException In case the passed object is not a map.
     * @return mixed
     * @see Maps::callback()
     */
    public static function last($map, callable $action) {
        if (!is_array($map) && !($map instanceof MapInterface)) {
            throw new InvalidArgumentException(
                'Passed argument was not a map.'
            );
        }

        $result = null;
        foreach ($map as $key => $value) {
            if ($action($value, $key, $map)) {
                $result = $value;
            }
        }
        return $result;
    }

}
