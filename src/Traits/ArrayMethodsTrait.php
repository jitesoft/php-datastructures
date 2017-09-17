<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayMethodsTrait.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Traits;

use Closure;
use Jitesoft\Utilities\DataStructures\Arrays;

/**
 * Trait ArrayMethodsTrait
 */
trait ArrayMethodsTrait {

    /**
     * @param Closure $closure
     * @return static
     */
    public function map(Closure $closure) {
        $out   = Arrays::map($this->toArray(), $closure);
        $class = get_class($this);
        return new $class($out);
    }

    /**
     * @param Closure $closure
     */
    public function forEach(Closure $closure): void {
        Arrays::forEach($this->toArray(), $closure);
    }

    /**
     * @param Closure $closure
     * @return static
     */
    public function filter(Closure $closure) {
        $out   = Arrays::filter($this->toArray(), $closure);
        $class = get_class($this);
        return new $class($out);
    }

    /**
     * @param Closure|null $closure
     * @return mixed
     */
    public function first(?Closure $closure = null) {
        return Arrays::first($this->toArray(), $closure);
    }

    /**
     * @param Closure|null $closure
     * @return mixed
     */
    public function last(?Closure $closure = null) {
        return Arrays::last($this->toArray(), $closure);
    }
}
