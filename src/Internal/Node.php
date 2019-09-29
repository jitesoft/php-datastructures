<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  Node.php - Part of the php-datastructures project.

  © - Jitesoft 2017
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace Jitesoft\Utilities\DataStructures\Internal;

use Jitesoft\Exceptions\Logic\InvalidArgumentException;

/**
 * Class Node
 * @internal
 *
 * Node structure used by tree and linked list -structures.
 */
class Node {

    /** @var mixed|null */
    private $object = null;
    /** @var array */
    private $links = [];

    /**
     * Node constructor.
     * @param mixed   $object Object to add to the node.
     * @param integer $links  Amount of links that the node use.
     * @internal
     */
    public function __construct($object, int $links) {
        for ($i = 0;$i < $links;$i++) {
            $this->links[] = null;
        }
        $this->object = $object;
    }

    /**
     * @param integer $index Index to check.
     * @throws InvalidArgumentException In case too many links are passed. Deprecated Exception.
     * @return void
     */
    private function boundsCheck(int $index) {
        $linkCount = count($this->links);
        if ($index < 0 || $index > $linkCount - 1) {
            $message = sprintf(
                'The node only have %d link%s.',
                $linkCount,
                ($linkCount === 1 ? '' : 's')
            );
            throw new InvalidArgumentException($message);
        }
    }

    /**
     * @param integer $link Link to fetch.
     * @return Node|null
     * @throws InvalidArgumentException Deprecated exception.
     */
    public function getLink(int $link): ?Node {
        $this->boundsCheck($link);
        return $this->links[$link];
    }

    /**
     * @return mixed|null
     */
    public function getItem() {
        return $this->object;
    }

    /**
     * @param mixed|null $object Object to set.
     * @return void
     */
    public function setItem($object) {
        $this->object = $object;
    }

    /**
     * @param integer   $link Link to set.
     * @param Node|null $node Node to add.
     * @throws InvalidArgumentException Deprecated exception.
     * @return void
     */
    public function setLink(int $link, ?Node $node = null) {
        $this->boundsCheck($link);
        $this->links[$link] = $node;
    }

}
