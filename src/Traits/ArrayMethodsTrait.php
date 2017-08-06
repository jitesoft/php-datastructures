<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayMethodsTrait.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Traits;

use Closure;
use Jitesoft\Utilities\DataStructures\StaticArrayMethods;

trait ArrayMethodsTrait {

    /**
     * @param Closure $closure
     * @return static
     */
    public function map(Closure $closure) {
        $out   = StaticArrayMethods::map($this, $closure);
        $class = get_class($this);
        return new $class($out);

    }

    /**
     * @param Closure $closure
     */
    public function forEach(Closure $closure): void {
        StaticArrayMethods::forEach($this, $closure);
    }

    /**
     * @param Closure $closure
     * @return static
     */
    public function filter(Closure $closure) {
        $out   = StaticArrayMethods::filter($this, $closure);
        $class = get_class($this);
        return new $class($out);
    }

    /**
     * @param Closure|null $closure
     * @return mixed
     */
    public function first(?Closure $closure = null) {
        return StaticArrayMethods::first($this, $closure);
    }

    /**
     * @param Closure|null $closure
     * @return mixed
     */
    public function last(?Closure $closure = null) {
        return StaticArrayMethods::last($this, $closure);
    }
}
