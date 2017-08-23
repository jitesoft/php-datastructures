<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Matrix44Test.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Math;

use Exception;
use Jitesoft\Utilities\DataStructures\Math\Math;
use Jitesoft\Utilities\DataStructures\Math\Matrix44 as Matrix;
use Jitesoft\Utilities\DataStructures\Math\Matrix44;
use Jitesoft\Utilities\DataStructures\Math\Matrix44Math;
use Jitesoft\Utilities\DataStructures\Math\MatrixMath;
use Jitesoft\Utilities\DataStructures\Math\Vector4D;
use PHPUnit\Framework\TestCase;

class Matrix44Test extends TestCase {


    public function testGetInnerVector() {
        $matrix = new Matrix();
        $this->assertInstanceOf(Vector4D::class, $matrix[0]);
        $this->assertInstanceOf(Vector4D::class, $matrix[1]);
        $this->assertInstanceOf(Vector4D::class, $matrix[2]);
        $this->assertInstanceOf(Vector4D::class, $matrix[3]);
    }

    public function testGetValue() {
        $matrix = new Matrix(
            1,2,3,4,
            5,6,7,8,
            9, 10, 11, 12,
            13, 14, 15, 16
        );

        $this->assertEquals(1, $matrix[0][0]);
        $this->assertEquals(2, $matrix[0][1]);
        $this->assertEquals(3, $matrix[0][2]);
        $this->assertEquals(4, $matrix[0][3]);

        $this->assertEquals(5, $matrix[1][0]);
        $this->assertEquals(6, $matrix[1][1]);
        $this->assertEquals(7, $matrix[1][2]);
        $this->assertEquals(8, $matrix[1][3]);

        $this->assertEquals(9, $matrix[2][0]);
        $this->assertEquals(10, $matrix[2][1]);
        $this->assertEquals(11, $matrix[2][2]);
        $this->assertEquals(12, $matrix[2][3]);

        $this->assertEquals(13, $matrix[3][0]);
        $this->assertEquals(14, $matrix[3][1]);
        $this->assertEquals(15, $matrix[3][2]);
        $this->assertEquals(16, $matrix[3][3]);
    }

    public function testGetValueOutOfRange() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Out of range. This matrix has 4 * 4 indexes.");

        $matrix = new Matrix();
        $matrix[10];
    }

    public function testSetValues() {

        $matrix = new Matrix();

        $matrix[0][0] = 10;
        $matrix[0][1] = 20;
        $matrix[0][2] = 30;
        $matrix[0][3] = 40;
        $matrix[1][0] = 50;
        $matrix[1][1] = 60;
        $matrix[1][2] = 70;
        $matrix[1][3] = 80;
        $matrix[2][0] = 90;
        $matrix[2][1] = 100;
        $matrix[2][2] = 110;
        $matrix[2][3] = 120;
        $matrix[3][0] = 130;
        $matrix[3][1] = 140;
        $matrix[3][2] = 150;
        $matrix[3][3] = 160;

        $this->assertEquals(10, $matrix[0][0]);
        $this->assertEquals(20, $matrix[0][1]);
        $this->assertEquals(30, $matrix[0][2]);
        $this->assertEquals(40, $matrix[0][3]);
        $this->assertEquals(50, $matrix[1][0]);
        $this->assertEquals(60, $matrix[1][1]);
        $this->assertEquals(70, $matrix[1][2]);
        $this->assertEquals(80, $matrix[1][3]);
        $this->assertEquals(90, $matrix[2][0]);
        $this->assertEquals(100, $matrix[2][1]);
        $this->assertEquals(110, $matrix[2][2]);
        $this->assertEquals(120, $matrix[2][3]);
        $this->assertEquals(130, $matrix[3][0]);
        $this->assertEquals(140, $matrix[3][1]);
        $this->assertEquals(150, $matrix[3][2]);
        $this->assertEquals(160, $matrix[3][3]);
    }

    public function testSetInnerError() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Invalid operation.");

        $matrix    = new Matrix();
        $matrix[0] = "value";
    }

    public function testUnsetError() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Invalid operation.");

        $matrix = new Matrix();
        unset($matrix[0]);
    }

    public function testSetIdentity() {
        $matrix = new Matrix();

        $static = MatrixMath::identity(Matrix44::class);
        $matrix->identity();

        $this->assertEquals($static, $matrix);
        $this->assertEquals(1, $matrix[0][0]);
        $this->assertEquals(0, $matrix[0][1]);
        $this->assertEquals(0, $matrix[0][2]);

        $this->assertEquals(0, $matrix[1][0]);
        $this->assertEquals(1, $matrix[1][1]);
        $this->assertEquals(0, $matrix[1][2]);

        $this->assertEquals(0, $matrix[2][0]);
        $this->assertEquals(0, $matrix[2][1]);
        $this->assertEquals(1, $matrix[2][2]);
    }

    public function testTranspose() {
        $m = new Matrix(
            1, 2, 3,
            4, 5, 6,
            7, 8, 9,
            10, 11, 12,
            13, 14, 15, 16
        );

        $m->transpose();

        $this->assertEquals(new Matrix(
            1, 5, 9, 13,
            2, 6, 10, 14,
            3, 7, 11, 15,
            4, 8, 12, 16
        ), $m);
    }

    public function testDeterminant() {
        $matrix = new Matrix(
            2,1,0, 5,
            2,0,0, 7,
            2,0,1, 9,
            3, 5,6,7
        );

        $this->assertEquals(11, $matrix->determinant());

        $matrix = new Matrix(
            6,1,1, 10,
            4,-2,5,22,
            2,8,7, 31,
            5, 22, 0, 1
        );

        $this->assertEquals(3531, $matrix->determinant());
    }

    public function testGetAdjoinMatrix() {
        $matrix = new Matrix(
            9, 3, 5, 8,
            -6, -9, 7, 9,
            -1, -8, 1, - 5,
            -2, 7, 12, 3
        );

        $minors = $matrix->getAdjoinMatrix();
        $this->assertEquals($minors, new Matrix(
            -1571, -377, -390, 367,
            -690, 552, -46, -1012,
            -1067, -1247, -1290, -1539,
            -341, -583, 1248, 615
        ));
    }

    public function testInverse() {
        $matrix = new Matrix(
            9,3,5, 9,
            -6,-9,7, 12,
            -1,-8, 1, 3,
            1, 2, 4, 5
        );

        $matrix->inverse();

        $det = 1/-750;
        $res = new Matrix44(
            -23, 97, -144, -105,
            -38, -68, 186, 120,
            276, 336, -522, -990,
            -201, -261, 372, 615
        );
        $res->mul($det);

        $this->assertEquals($res, $matrix);
    }

    public function testMulMatrix() {
        $matrix1 = new Matrix(1,2,3,4,5,6,7,8,9, 10, 11, 12, 13, 14, 15, 16);
        $matrix2 = new Matrix(1,2,3,4,5,6,7,8,9, 10, 11, 12, 13, 14, 15, 16);

        $result = MatrixMath::mul($matrix1, $matrix2);
        $matrix1->mul($matrix2);

        $this->assertEquals($matrix1, $result);
        $this->assertEquals(new Matrix(
            90, 100, 110, 120,
            202, 228, 254, 280,
            314, 356, 398, 440,
            426,  484, 542, 600
        ), $matrix1);
    }

    public function testMulFloat() {
        $matrix = new Matrix(1,2,3,4,5,6,7,8,9,10, 11, 12, 13, 14, 15, 16);
        $scalar = 10;

        $result = MatrixMath::mul($matrix, $scalar);
        $matrix->mul($scalar);

        $this->assertEquals($result, $matrix);
        $this->assertEquals(new Matrix(
            10 ,20, 30, 40,
            50, 60, 70, 80,
            90, 100, 110, 120,
            130, 140, 150, 160
        ), $matrix);
    }

    public function testMulError() {
        $matrix = new Matrix();
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Invalid type. Can not multiply a matrix with string.");

        $matrix->mul("aaa");
    }

    public function testAdd() {
        $matrix  = new Matrix(-5, -1, 5, 1, -2, 1, 1, 9, -5, 3, 12, 17, 9, 3, 9, 2);
        $matrix2 = new Matrix(2, 2, 9, -3, 5, 2, 3, 8 ,3, 1, 1, 1, 3, 4, 5, 3);

        $result = Matrix44Math::add($matrix, $matrix2);
        $matrix->add($matrix2);

        $this->assertEquals($matrix, $result);
        $this->assertEquals(new Matrix(
            -3, 1, 14,
            -2, 3, 3,
            4, 17, -2

        ), $matrix);
    }

    public function testSub() {
        $matrix  = new Matrix(-5, -1, 5, 1, -2, 1, 1, 9, -5, 3, 12, 17, 9, 3, 9, 2);
        $matrix2 = new Matrix(2, 2, 9, -3, 5, 2, 3, 8 ,3, 1, 1, 1, 3, 4, 5, 3);

        $result = Matrix44Math::sub($matrix, $matrix2);
        $matrix->sub($matrix2);

        $this->assertEquals($matrix, $result);
        $this->assertEquals(new Matrix(
            14, -4, -9,
            4, 5, 1,
            5, -6, 14
        ), $matrix);
    }

    public function testRotationX() {
        $matrix  = Matrix44Math::makeRotationX(90);
        $matrix2 = Matrix44Math::makeRotationX(90 * (pi() / 180), Math::RADIANS);

        $this->assertEquals($matrix, $matrix2);
        $this->assertEquals(new Matrix(
            1,0,0,
            0,0,-1,
            0,1,0
        ), $matrix);
    }

    public function testRotationY() {
        $matrix  = Matrix44Math::makeRotationY(90);
        $matrix2 = Matrix44Math::makeRotationY(90 * (pi() / 180), Math::RADIANS);

        $this->assertEquals($matrix, $matrix2);
        $this->assertEquals(new Matrix(
            0,0,1,
            0,1,0,
            -1,0,0
        ), $matrix);
    }

    public function testRotationZ() {
        $matrix  = Matrix44Math::makeRotationZ(90);
        $matrix2 = Matrix44Math::makeRotationZ(90 * (pi() / 180), Math::RADIANS);

        $this->assertEquals($matrix, $matrix2);
        $this->assertEquals(new Matrix(
            0,-1,0,
            1,0,0,
            0,0,1
        ), $matrix);
    }


    public function testSetRotationX() {
        $matrix  = new Matrix(-5, -1, 5, 1, -2, 1, 1, 9, -5, 3, 12, 17, 9, 3, 9, 2);
        $matrix2 = new Matrix(2, 2, 9, -3, 5, 2, 3, 8 ,3, 1, 1, 1, 3, 4, 5, 3);

        $matrix->setRotationX((90 * (pi()/180)), Math::RADIANS);
        $matrix2->roll(90);

        $this->assertEquals($matrix2, $matrix);
        $this->assertEquals(new Matrix(
            10, -4, -2,
            91, 2, -7,
            11, 52, -41
        ), $matrix);

    }

    public function testSetRotationY() {
        $matrix  = new Matrix(-5, -1, 5, 1, -2, 1, 1, 9, -5, 3, 12, 17, 9, 3, 9, 2);
        $matrix2 = new Matrix(2, 2, 9, -3, 5, 2, 3, 8 ,3, 1, 1, 1, 3, 4, 5, 3);

        $matrix->setRotationY((90 * (pi()/180)), Math::RADIANS);
        $matrix2->pitch(90);

        $this->assertEquals($matrix2, $matrix);
        $this->assertEquals(new Matrix(
            4, 2, 10,
            -2, 7, 91,
            -52, 41, 11
        ), $matrix);
    }

    public function testSetRotationZ() {
        $matrix  = new Matrix(-5, -1, 5, 1, -2, 1, 1, 9, -5, 3, 12, 17, 9, 3, 9, 2);
        $matrix2 = new Matrix(2, 2, 9, -3, 5, 2, 3, 8 ,3, 1, 1, 1, 3, 4, 5, 3);

        $matrix->setRotationZ((90 * (pi()/180)), Math::RADIANS);
        $matrix2->yaw(90);

        $this->assertEquals($matrix2, $matrix);
        $this->assertEquals(new Matrix(
            2, -10, -4,
            7, -91, 2,
            41, -11, 52
        ), $matrix);
    }

    public function testFromArray() {
        $matrixAsArray = [
            [0, 1, 2, 3],
            [4, 5, 6, 7],
            [8, 9, 10, 11],
            [12, 13, 14, 15]
        ];

        $matrix = new Matrix();
        $matrix->fromArray($matrixAsArray);

        $this->assertEquals(new Matrix(
            0, 1, 2, 3,
            4, 5, 6, 7,
            8, 9, 10, 11,
            12, 13, 14, 15
        ), $matrix);
    }

    public function testToArray() {
        $matrix = new Matrix(
            0, 1, 2, 3,
            4, 5, 6, 7,
            8, 9, 10, 11,
            12, 13, 14, 15
        );

        $matrixAsArray = $matrix->toArray();

        $this->assertEquals(
            [
                [0, 1, 2, 3],
                [4, 5, 6, 7],
                [8, 9, 10, 11],
                [12, 13, 14, 15]
            ],
            $matrixAsArray
        );
    }
}
