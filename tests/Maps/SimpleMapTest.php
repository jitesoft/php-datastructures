<?php /** @noinspection ALL */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  SimpleMapTest.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Tests\Maps;

use Jitesoft\Utilities\DataStructures\Maps\SimpleMap;
use Jitesoft\Utilities\DataStructures\Tests\Traits\MapMethodsTestTrait;
use Jitesoft\Utilities\DataStructures\Tests\Traits\MapTestTrait;
use PHPUnit\Framework\TestCase;

class SimpleMapTest extends TestCase {
    use MapTestTrait;
    use MapMethodsTestTrait;

    protected function setUp(): void {
        parent::setUp();

        $this->implementation = new SimpleMap();
    }

}
