<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector3DTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Math;

use Jitesoft\Utilities\DataStructures\Math\Vector3D;
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


    public function testDistance() {
        $vector1 = new Vector(1,2,3);
        $vector2 = new Vector(10, 11, 12);

        $result1 = Vector3DMath::distance($vector1, $vector2);
        $result2 = $vector1->distance($vector2);

        $this->assertEquals($result1, $result2);

        $this->assertEquals(15.58, $result1, "", 2);
    }

    public function testDistance2() {
        $vector1 = new Vector(1,2,3);
        $vector2 = new Vector(10, 11, 12);

        $result1 = Vector3DMath::distance2($vector1, $vector2);
        $result2 = $vector1->distance2($vector2);

        $this->assertEquals($result1, $result2);
        $this->assertEquals(243, $result1);
    }

    public function testDot() {
        $vector1 = new Vector(1,2,3);
        $vector2 = new Vector(10, 11, 12);

        $result1 = Vector3DMath::dot($vector1, $vector2);
        $result2 = $vector1->dot($vector2);

        $this->assertEquals($result2, $result1);
        $this->assertEquals(68, $result1);
    }

    public function testCross() {
        $vector1 = new Vector(2,3,4);
        $vector2 = new Vector(5, 6, 7);

        $result1 = Vector3DMath::cross($vector1, $vector2);
        $vector1->cross($vector2);

        $this->assertEquals($vector1, $result1);
        $this->assertEquals(-3, $vector1->getX());
        $this->assertEquals(6, $vector1->getY());
        $this->assertEquals(-3, $vector1->getZ());
    }

    public function testNormalize() {
        $vector1 = new Vector(2,3,4);
        $vector1->normalize();

        $this->assertEquals(0.37, $vector1->getX(), "", 2);
        $this->assertEquals(0.55, $vector1->getY(), "", 2);
        $this->assertEquals(0.74, $vector1->getZ(), "", 2);

        $this->assertEquals(1, $vector1->length());
    }

    public function testLength() {
        $vector1 = new Vector(2,3,4);
        $this->assertEquals(sqrt(29), $vector1->length());
    }

    public function testLength2() {
        $vector1 = new Vector(2,3,4);
        $this->assertEquals(29, $vector1->length2());
    }

    public function testOffsetExists() {
        $vector = new Vector(1,2,3);

        $this->assertFalse($vector->offsetExists(3));
        $this->assertFalse($vector->offsetExists(-1));

        $this->assertTrue($vector->offsetExists(0));
        $this->assertTrue($vector->offsetExists('x'));
        $this->assertTrue($vector->offsetExists('X'));

        $this->assertTrue($vector->offsetExists(1));
        $this->assertTrue($vector->offsetExists('y'));
        $this->assertTrue($vector->offsetExists('Y'));

        $this->assertTrue($vector->offsetExists(2));
        $this->assertTrue($vector->offsetExists('z'));
        $this->assertTrue($vector->offsetExists('Z'));
    }


    public function testOffsetGet() {
        $vector = new Vector(1,2,3);

        $this->assertEquals(1, $vector[0]);
        $this->assertEquals(1, $vector['x']);
        $this->assertEquals(1, $vector['X']);

        $this->assertEquals(2, $vector[1]);
        $this->assertEquals(2, $vector['y']);
        $this->assertEquals(2, $vector['Y']);

        $this->assertEquals(3, $vector[2]);
        $this->assertEquals(3, $vector['z']);
        $this->assertEquals(3, $vector['Z']);
    }

    public function testOffsetSet() {

        $vector = new Vector(10,20,30);

        $vector[0] = 1;
        $this->assertEquals(1, $vector->getX());
        $vector['x'] = 10;
        $this->assertEquals(10, $vector->getX());
        $vector['X'] = 100;
        $this->assertEquals(100, $vector->getX());

        $vector[1] = 1;
        $this->assertEquals(1, $vector->getY());
        $vector['y'] = 10;
        $this->assertEquals(10, $vector->getY());
        $vector['Y'] = 100;
        $this->assertEquals(100, $vector->getY());

        $vector[2] = 1;
        $this->assertEquals(1, $vector->getZ());
        $vector['z'] = 10;
        $this->assertEquals(10, $vector->getZ());
        $vector['Z'] = 100;
        $this->assertEquals(100, $vector->getZ());

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid value. Value must be a number.");

        $vector['x'] = "HI!";
    }

    public function testOffsetUnset() {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid method.");

        (new Vector3D(1,2,3))->offsetUnset(1);
    }
}
