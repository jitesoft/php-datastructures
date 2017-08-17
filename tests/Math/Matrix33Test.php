<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix33Test.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Math;

use Jitesoft\Utilities\DataStructures\Math\Matrix33 as Matrix;
use Jitesoft\Utilities\DataStructures\Math\Vector3D as Vector;
use PHPUnit\Framework\TestCase;

class Matrix33Test extends TestCase {


    public function testGetInnerVector() {
        $matrix = new Matrix(1,2,3,4,5,6,7,8,9);
        $this->assertInstanceOf(Vector::class, $matrix[0]);
        $this->assertInstanceOf(Vector::class, $matrix[1]);
        $this->assertInstanceOf(Vector::class, $matrix[2]);
    }

    public function testGetValue() {}

}
