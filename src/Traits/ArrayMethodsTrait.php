<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayMethodsTrait.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays\Traits;

use Closure;
use Jitesoft\Utilities\Arrays\StaticArrayMethods;

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
}
