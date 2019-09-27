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

    private function __construct() { }

    /**
     * @param mixed              $value - Value of the current Iteration.
     * @param mixed              $key   - Key of the current iteration.
     * @param MapInterface|array $list  - The map which is being iterated.
     * @return mixed
     * @throws NotImplementedException
     * @codeCoverageIgnore
     */
    private static function callback($value, $key, $list) {
        throw new NotImplementedException('...');
    }

    /**
     * Foreach method for a MapInterface implementation.
     *
     * Loops through the Map and passes the value, key and Map to the action for each iteration.
     * If the action returns false, it will stop the loop, i.e., as a break.
     *
     * @param MapInterface|array $map
     * @param callable           $action {@see Maps::callback()}
     * @throws InvalidArgumentException
     */
    public static function forEach($map, callable $action) {
        if (!is_array($map) && !($map instanceof MapInterface)) {
            throw new InvalidArgumentException('Passed argument was not a map.');
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
     * @param MapInterface|array $map
     * @param callable           $action {@see Maps::callback()}
     * @throws InvalidArgumentException
     * @return MapInterface|array
     */
    public static function map($map, callable $action) {
        if (!is_array($map) && !($map instanceof MapInterface)) {
            throw new InvalidArgumentException('Passed argument was not a map.');
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
     * @param MapInterface|array $map
     * @param callable           $action {@see Maps::callback()}
     * @throws InvalidArgumentException
     * @return MapInterface|array
     */
    public static function filter($map, callable $action) {
        if (!is_array($map) && !($map instanceof MapInterface)) {
            throw new InvalidArgumentException('Passed argument was not a map.');
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
     * @param MapInterface|array $map
     * @param callable           $action {@see Maps::callback()}
     * @throws InvalidArgumentException
     * @return mixed
     */
    public static function first($map, callable $action) {
        if (!is_array($map) && !($map instanceof MapInterface)) {
            throw new InvalidArgumentException('Passed argument was not a map.');
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
     * @param MapInterface|array $map
     * @param callable           $action {@see Maps::callback()}
     * @throws InvalidArgumentException
     * @return mixed
     */
    public static function last($map, callable $action) {
        if (!is_array($map) && !($map instanceof MapInterface)) {
            throw new InvalidArgumentException('Passed argument was not a map.');
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
