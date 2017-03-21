<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  StaticArrayMethods.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays;

use Closure;

final class StaticArrayMethods {

    public static function forEach($array, Closure $closure): void {
        $count = count($array);
        for ($i=0;$i<$count;$i++) {
            $result = $closure($array[$i], $i, $array);
            if ($result === false) {
                return;
            }
        }
    }

    public static function map($array, Closure $closure): array {
        $result = [];
        $count  = count($array);
        for ($i=0;$i<$count;$i++) {
            $result[] = $closure($array[$i], $i, $array);
        }
        return $result;
    }

    public static function filter($array, Closure $closure): array {
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
     * @param $array
     * @param Closure|null|null $closure
     * @return mixed
     */
    public static function first($array, ?Closure $closure = null) {
        if ($closure === null) {
            return $array[0];
        }

        $count = count($array);
        for ($i=0;$i<$count;$i++) {
            if ($closure($array[$i], $i, $array)) {
                return $array[$i];
            }
        }
        return null;
    }
}
