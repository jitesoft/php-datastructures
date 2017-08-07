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

    public function testSub() {}

    public function testMul() {}

    public function testDiv() {}

    public function testMulF() {}
    
    public function testDivF() {}

    public function testLength() {}
    public function testLength2() {}

    public function testNormalize() {}
    public function testDot() {}

    public function testDistance() {}
    public function testDistanceSquared() {}

}
