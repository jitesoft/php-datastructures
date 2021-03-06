<?php /** @noinspection ALL */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  LinkedQueueTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Queues;

use Jitesoft\Utilities\DataStructures\Queues\LinkedQueue;
use Jitesoft\Utilities\DataStructures\Tests\Traits\QueueTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @group LinkedStructures
 * @group Queues
 * @group Lists
 */
class LinkedQueueTest extends TestCase {
    use QueueTestTrait;

    public function setUp(): void {
        parent::setUp();

        $this->implementation = new LinkedQueue();
    }

}
