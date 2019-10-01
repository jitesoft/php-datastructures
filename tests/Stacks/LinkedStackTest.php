<?php /** @noinspection ALL */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  LinkedStackTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Stacks;

use Jitesoft\Utilities\DataStructures\Stacks\LinkedStack;
use Jitesoft\Utilities\DataStructures\Tests\Traits\StackTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @group LinkedStructures
 * @group Stacks
 * @group Lists
 */
class LinkedStackTest extends TestCase {
    use StackTestTrait;

    public function setUp(): void {
        parent::setUp();

        $this->implementation = new LinkedStack();
    }

}
