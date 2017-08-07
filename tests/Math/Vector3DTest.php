<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector3DTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Math;

use Jitesoft\Utilities\DataStructures\Math\Vector3DMath;
use PHPUnit\Framework\TestCase;
use Jitesoft\Utilities\DataStructures\Math\Vector3D as Vector;

class Vector3DTest extends TestCase {

    public function testGet() {
        $v = new Vector(1,2,3);
        $this->assertEquals(1, $v->getX());
        $this->assertEquals(2, $v->getY());
        $this->assertEquals(3, $v->getZ());
    }

    public function testSet() {
        $v = new Vector(1,2,3);
        $v->setX(10);
        $v->setY(20);
        $v->setZ(30);
        $this->assertEquals(10, $v->getX());
        $this->assertEquals(20, $v->getY());
        $this->assertEquals(30, $v->getZ());
    }

    public function testAdd() {
        $v1 = new Vector(1, 2, 3);
        $v2 = new Vector(4, 5, 6);

        $result = Vector3DMath::add($v1, $v2);
        $v1->add($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(5, $v1->getX());
        $this->assertEquals(7, $v1->getY());
        $this->assertEquals(9, $v1->getZ());
    }

    public function testSub() {
        $v1 = new Vector(10, 11, 12);
        $v2 = new Vector(1, 3, 5);

        $result = Vector3DMath::sub($v1, $v2);
        $v1->sub($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(9, $v1->getX());
        $this->assertEquals(8, $v1->getY());
        $this->assertEquals(7, $v1->getZ());
    }

    public function testMul() {
        $v1 = new Vector(10, 11, 12);
        $v2 = new Vector(1, 2, 3);

        $result = Vector3DMath::mul($v1, $v2);
        $v1->mul($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(10, $v1->getX());
        $this->assertEquals(22, $v1->getY());
        $this->assertEquals(36, $v1->getZ());
    }

    public function testDiv() {
        $v1 = new Vector(10, 18, 12);
        $v2 = new Vector(2, 3, 3);

        $result = Vector3DMath::div($v1, $v2);
        $v1->div($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(5, $v1->getX());
        $this->assertEquals(6, $v1->getY());
        $this->assertEquals(4, $v1->getZ());
    }

    public function testMulF() {
        $v1 = new Vector(10, 18, 12);

        $result = Vector3DMath::mul($v1, 2);
        $v1->mul(2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(20, $v1->getX());
        $this->assertEquals(36, $v1->getY());
        $this->assertEquals(24, $v1->getZ());
    }


    public function testDivF() {
        $v1 = new Vector(10, 18, 12);

        $result = Vector3DMath::div($v1, 2);
        $v1->div(2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(5, $v1->getX());
        $this->assertEquals(9, $v1->getY());
        $this->assertEquals(6, $v1->getZ());
    }


    public function testDistance() {}
    public function testDistance2() {}

    public function testDot() {}
    public function testCross() {}

    public function testNormalize() {}
    public function testLength() {}
    public function testLength2() {}

}
