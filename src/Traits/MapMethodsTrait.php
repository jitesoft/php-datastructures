<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  MapMethodsTrait.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Traits;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Maps;
use Jitesoft\Utilities\DataStructures\Maps\MapInterface;

trait MapMethodsTrait {

    /**
     * Foreach method for a MapInterface implementation.
     *
     * Loops through the Map and passes the value, key and Map to the action for each iteration.
     * If the action returns false, it will stop the loop, i.e., as a break.
     *
     * @param callable $action Callback to invoke on each object {@see Maps::callback()} .
     * @return void
     * @throws InvalidArgumentException In case argument is not a map.
     */
    public function forEach(callable $action) {
        Maps::forEach($this, $action);
    }

    /**
     * Method to iterate and apply a callback to each value in a MapInterface implementation.
     *
     * Loops through the Map and passes the value, key and Map to the action for each iteration.
     * Value returned from the method will be added to the returned map.
     *
     * @param callable $action Callback to test each object with {@see Maps::callback()}.
     * @return MapInterface
     * @throws InvalidArgumentException In case argument is not a map.
     */
    public function map(callable $action) : MapInterface {
        return Maps::map($this, $action);
    }

    /**
     * Loops through the Map and applies the action to it.
     * If action returns true, the object will be added to the resulting map returned at the end of the iteration.
     *
     * @param callable $action Callback to test each object with {@see Maps::callback()}.
     * @return MapInterface
     * @throws InvalidArgumentException In case argument is not a map.
     */
    public function filter(callable $action) : MapInterface {
        return Maps::filter($this, $action);
    }

    /**
     * Fetches the first value on which the action returns true.
     *
     * @param callable $action Callback to test each object with {@see Maps::callback()}.
     * @return mixed
     * @throws InvalidArgumentException In case argument is not a map.
     */
    public function first(callable $action) {
        return Maps::first($this, $action);
    }

    /**
     * Fetches the last value on which the action returns true.
     *
     * @param callable $action Callback to test each object with {@see Maps::callback()}.
     * @return mixed
     * @throws InvalidArgumentException In case argument is not a map.
     */
    public function last(callable $action) {
        return Maps::last($this, $action);
    }

}
