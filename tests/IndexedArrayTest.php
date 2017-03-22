<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  IndexedArrayTest.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays\Tests;

use Jitesoft\Utilities\Arrays\IndexedArray;
use Jitesoft\Utilities\Arrays\Tests\Traits\ArrayMethodsTestTrait;
use Jitesoft\Utilities\Arrays\Tests\Traits\IndexedArrayTestTrait;
use PHPUnit\Framework\TestCase;

class IndexedArrayTest extends TestCase {
    use IndexedArrayTestTrait;
    use ArrayMethodsTestTrait;


    public function setUp() {
        parent::setUp();

        $this->implementation = new IndexedArray();
    }
}
