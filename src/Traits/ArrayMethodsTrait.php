<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayMethodsTrait.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Traits;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;
use Jitesoft\Utilities\DataStructures\Arrays;

/**
 * Trait ArrayMethodsTrait
 */
trait ArrayMethodsTrait {

    /**
     * @param callable $closure Callback to invoke for each object.
     * @return static
     */
    public function map(callable $closure) {
        $out   = Arrays::map($this->toArray(), $closure);
        $class = get_class($this);
        return new $class($out);
    }

    /**
     * @param callable $closure Callback to invoke on each object.
     * @return void
     */
    public function forEach(callable $closure): void {
        Arrays::forEach($this->toArray(), $closure);
    }

    /**
     * @param callable $closure Callback to use for test for each object.
     * @return static
     */
    public function filter(callable $closure) {
        $out   = Arrays::filter($this->toArray(), $closure);
        $class = get_class($this);
        return new $class($out);
    }

    /**
     * @param callable|null $closure Callback to use for test for each object.
     * @return mixed
     */
    public function first(?callable $closure = null) {
        return Arrays::first($this->toArray(), $closure);
    }

    /**
     * @param callable|null $closure Callback to use for test for each object.
     * @return mixed
     */
    public function last(?callable $closure = null) {
        return Arrays::last($this->toArray(), $closure);
    }

    /**
     * @param callable|null $compare  Callback to use for test for each truple.
     * @param string        $sortType Sorting algorithm.
     * @return static
     * @throws InvalidArgumentException In case value is not an array.
     */
    public function sort(?callable $compare = null,
                        string $sortType = Arrays::QUICK_SORT) {
        $out   = Arrays::sort($this->toArray(), $compare, $sortType);
        $class = get_class($this);
        return new $class($out);
    }

}
