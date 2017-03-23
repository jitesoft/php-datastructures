<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  IndexedListTest.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\Arrays\Tests;

use Jitesoft\Utilities\Arrays\IndexedList;
use Jitesoft\Utilities\Arrays\Tests\Traits\ArrayMethodsTestTrait;
use Jitesoft\Utilities\Arrays\Tests\Traits\IndexedListTestTrait;
use PHPUnit\Framework\TestCase;

class IndexedListTest extends TestCase {
    use IndexedListTestTrait;
    use ArrayMethodsTestTrait;


    public function setUp() {
        parent::setUp();

        $this->implementation = new IndexedList();
    }
}
