<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  ArrayQueueTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Queues;

use Jitesoft\Utilities\DataStructures\Queues\ArrayQueue;
use Jitesoft\Utilities\DataStructures\Tests\Traits\QueueTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @group Queues
 * @group Lists
 */
class ArrayQueueTest extends TestCase {
    use QueueTestTrait;


    public function setUp(): void  {
        parent::setUp();

        $this->implementation = new ArrayQueue();
    }

}
