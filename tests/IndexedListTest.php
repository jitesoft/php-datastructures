<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  IndexedListTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests;

use Jitesoft\Utilities\DataStructures\IndexedList;
use Jitesoft\Utilities\DataStructures\Tests\Traits\ArrayMethodsTestTrait;
use Jitesoft\Utilities\DataStructures\Tests\Traits\IndexedListTestTrait;
use PHPUnit\Framework\TestCase;

class IndexedListTest extends TestCase {
    use IndexedListTestTrait;
    use ArrayMethodsTestTrait;


    public function setUp() {
        parent::setUp();

        $this->implementation = new IndexedList();
    }
}
