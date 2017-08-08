<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector4DTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Math;

use Jitesoft\Utilities\DataStructures\Math\Vector4D as Vector;

use Jitesoft\Utilities\DataStructures\Math\Vector4DMath;
use PHPUnit\Framework\TestCase;

class Vector4DTest extends TestCase {

    public function testGet() {
        $v = new Vector(1,2,3,4);

        $this->assertEquals(1, $v->getX());
        $this->assertEquals(2, $v->getY());
        $this->assertEquals(3, $v->getZ());
        $this->assertEquals(4, $v->getW());
    }
    public function testSet() {
        $v = new Vector(5,6,7,8);

        $v->setX(1);
        $v->setY(2);
        $v->setZ(3);
        $v->setW(4);

        $this->assertEquals(1, $v->getX());
        $this->assertEquals(2, $v->getY());
        $this->assertEquals(3, $v->getZ());
        $this->assertEquals(4, $v->getW());
    }

    public function testMul() {
        $v1 = new Vector(1,2,3,4);
        $v2 = new Vector(2,3,4,5);

        $result = Vector4DMath::mul($v1, $v2);
        $v1->mul($v2);

        $this->assertEquals($result, $v1);
        $this->assertEquals(2, $v1->getX());
        $this->assertEquals(6, $v1->getY());
        $this->assertEquals(12, $v1->getZ());
        $this->assertEquals(20, $v1->getW());
    }


    public function testDiv() {
        $v1 = new Vector(2,12,6,25);
        $v2 = new Vector(2,4,3,5);

        $result = Vector4DMath::div($v1, $v2);
        $v1->div($v2);

        $this->assertEquals($result, $v1);
        $this->assertEquals(1, $v1->getX());
        $this->assertEquals(3, $v1->getY());
        $this->assertEquals(3, $v1->getZ());
        $this->assertEquals(5, $v1->getW());
    }

    public function testAdd() {
        $v1 = new Vector(1,2,3,4);
        $v2 = new Vector(2,3,4,5);

        $result = Vector4DMath::add($v1, $v2);
        $v1->add($v2);

        $this->assertEquals($result, $v1);
        $this->assertEquals(3, $v1->getX());
        $this->assertEquals(5, $v1->getY());
        $this->assertEquals(7, $v1->getZ());
        $this->assertEquals(9, $v1->getW());
    }

    public function testSub() {
        $v1 = new Vector(1,5,12,100);
        $v2 = new Vector(2,3,4,5);

        $result = Vector4DMath::sub($v1, $v2);
        $v1->sub($v2);

        $this->assertEquals($result, $v1);
        $this->assertEquals(-1, $v1->getX());
        $this->assertEquals(2, $v1->getY());
        $this->assertEquals(8, $v1->getZ());
        $this->assertEquals(95, $v1->getW());}

    public function testMulF() {
        $v1 = new
        Vector(1,2,3,4);

        $result = Vector4DMath::mul($v1, 4);
        $v1->mul(4);

        $this->assertEquals($result, $v1);
        $this->assertEquals(4, $v1->getX());
        $this->assertEquals(8, $v1->getY());
        $this->assertEquals(12, $v1->getZ());
        $this->assertEquals(16, $v1->getW());
    }


    public function testDivF() {
        $v1 = new Vector(1,2,3,4);

        $result = Vector4DMath::div($v1, 2);
        $v1->div(2);

        $this->assertEquals($result, $v1);
        $this->assertEquals(0.5, $v1->getX(), "", 1);
        $this->assertEquals(1, $v1->getY());
        $this->assertEquals(1.5, $v1->getZ(), "", 1);
        $this->assertEquals(2, $v1->getW());

    }

    public function testCross() {}

    public function testDot() {}

    public function testDistance() {}

    public function testDistance2() {}

    public function testNormalize() {}

    public function testLength() {}

    public function testLength2() {}
}
