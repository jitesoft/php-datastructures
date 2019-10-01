<?php /** @noinspection ALL */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  LinkedListTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Lists;

use Jitesoft\Utilities\DataStructures\Lists\LinkedList;
use Jitesoft\Utilities\DataStructures\Tests\Traits\ArrayMethodsTestTrait;
use Jitesoft\Utilities\DataStructures\Tests\Traits\IndexedListTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @group LinkedStructures
 * @group IndexedLists
 * @group Lists
 */
class LinkedListTest extends TestCase {
    use IndexedListTestTrait;
    use ArrayMethodsTestTrait;

    public function setUp(): void {
        parent::setUp();

        $this->implementation = new LinkedList();
    }

}
