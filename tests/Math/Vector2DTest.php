<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Vector2DTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace Jitesoft\Utilities\DataStructures\Tests\Math;

use Jitesoft\Utilities\DataStructures\Math\Vector2D;
use Jitesoft\Utilities\DataStructures\Math\Vector2DMath;
use PHPUnit\Framework\TestCase;

class Vector2DTest extends TestCase {

    public function testGetXY() {
        $v = new Vector2D(5,15);
        $this->assertEquals(5, $v->getX());
        $this->assertEquals(15, $v->getY());
    }

    public function testSetXY() {
        $v = new Vector2D(1,10);

        $this->assertEquals(1, $v->getX());
        $this->assertEquals(10, $v->getY());

        $v->setX(10);
        $v->setY(20);

        $this->assertEquals(10, $v->getX());
        $this->assertEquals(20, $v->getY());
    }

    public function testSet() {
        $v = new Vector2D(1,10);

        $this->assertEquals(1, $v->getX());
        $this->assertEquals(10, $v->getY());

        $v->set(10, 20);

        $this->assertEquals(10, $v->getX());
        $this->assertEquals(20, $v->getY());
    }

    public function testAdd() {
        $v1 = new Vector2D(10, 20);
        $v2 = new Vector2D(20, 20);

        $result = Vector2DMath::add($v1, $v2);
        $v1->add($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(30, $result->getX());
        $this->assertEquals(40, $result->getY());

    }

    public function testSub() {
        $v1 = new Vector2D(10, 20);
        $v2 = new Vector2D(3, 12);

        $result = Vector2DMath::sub($v1, $v2);
        $v1->sub($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(7, $v1->getX());
        $this->assertEquals(8, $v1->getY());
    }

    public function testMul() {
        $v1 = new Vector2D(10, 20);
        $v2 = new Vector2D(2, 3);

        $result = Vector2DMath::mul($v1, $v2);
        $v1->mul($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(20, $v1->getX());
        $this->assertEquals(60, $v1->getY());
    }

    public function testDiv() {
        $v1 = new Vector2D(10, 12);
        $v2 = new Vector2D(2, 3);

        $result = Vector2DMath::div($v1, $v2);
        $v1->div($v2);

        $this->assertEquals($v1, $result);
        $this->assertEquals(5, $v1->getX());
        $this->assertEquals(4, $v1->getY());
    }

    public function testMulF() {
        $v1 = new Vector2D(10, 1);
        $result = Vector2DMath::mul($v1, 5);
        $v1->mul(5);

        $this->assertEquals($result, $v1);
        $this->assertEquals(50, $v1->getX());
        $this->assertEquals(5, $v1->getY());
    }

    public function testDivF() {
        $v1 = new Vector2D(100, 10);
        $result = Vector2DMath::div($v1, 10);
        $v1->div(10);

        $this->assertEquals($result, $v1);
        $this->assertEquals(10, $v1->getX());
        $this->assertEquals(1, $v1->getY());
    }

    public function testLength() {
        $v1 = new Vector2D(10, 5);
        $len = $v1->length();

        $this->assertEquals(sqrt(125), $len);
    }

    public function testLength2() {
        $v = new Vector2D(10, 5);
        $len = $v->length2();

        $this->assertEquals(125, $len);
    }

    public function testNormalize() {
        $v = new Vector2D(10, 5);
        $v->normalize();

        $this->assertEquals(1, $v->length());
        $this->assertequals(0.89, $v->getX(), "", 2);
        $this->assertEquals(0.44, $v->getY(), "", 2);
    }

    public function testDot() {
        $v1 = new Vector2D(10, 15);
        $v2 = new Vector2D(20, 25);
        $result = $v1->dot($v2);

        $this->assertEquals(575, $result);
    }

    public function testDistance() {
        $v1 = new Vector2D(10, 15);
        $v2 = new Vector2D(20, 25);

        $dist = $v1->distance($v2);

        $this->assertEquals(sqrt(200), $dist);
    }

    public function testDistanceSquared() {
        $v1 = new Vector2D(10, 15);
        $v2 = new Vector2D(20, 25);

        $dist = $v1->distance2($v2);

        $this->assertEquals(200, $dist);
    }

}
