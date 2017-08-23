<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayStackTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Stacks;

use Jitesoft\Utilities\DataStructures\Stacks\ArrayStack;
use Jitesoft\Utilities\DataStructures\Tests\Traits\StackTestTrait;
use PHPUnit\Framework\TestCase;

class ArrayStackTest extends TestCase {
    use StackTestTrait;

    protected function setUp() {
        parent::setUp();

        $this->implementation = new ArrayStack();
    }
}
