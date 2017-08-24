<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  LinkedQueueTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Queues;

use Jitesoft\Utilities\DataStructures\Queues\LinkedQueue;
use Jitesoft\Utilities\DataStructures\Tests\Traits\QueueTestTrait;
use PHPUnit\Framework\TestCase;

class LinkedQueueTest extends TestCase {
    use QueueTestTrait;

    public function setUp() {
        parent::setUp();

        $this->implementation = new LinkedQueue();
    }

}
