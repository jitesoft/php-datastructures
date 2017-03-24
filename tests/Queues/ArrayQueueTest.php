<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayQueueTest.php - Part of the php-list project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Queues;

use Jitesoft\Utilities\DataStructures\Queues\ArrayQueue;
use Jitesoft\Utilities\DataStructures\Tests\Traits\QueueTestTrait;
use PHPUnit\Framework\TestCase;

class ArrayQueueTest extends TestCase {
    use QueueTestTrait;


    public function setUp() {
        parent::setUp();

        $this->implementation = new ArrayQueue();
    }

}
