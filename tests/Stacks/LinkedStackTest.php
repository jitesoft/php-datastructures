<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  LinkedStackTest.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Stacks;

use Jitesoft\Utilities\DataStructures\Stacks\LinkedStack;
use Jitesoft\Utilities\DataStructures\Tests\Traits\StackTestTrait;
use PHPUnit\Framework\TestCase;

class LinkedStackTest extends TestCase {
    use StackTestTrait;

    public function setUp() {
        parent::setUp();
        $this->implementation = new LinkedStack();
    }
}
