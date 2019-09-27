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

    private $object = null;
    private $links  = [];

    /**
     * Node constructor.
     * @param     $object
     * @param integer $links
     * @internal
     */
    public function __construct($object, int $links) {
        for ($i = 0;$i < $links;$i++) {
            $this->links[] = null;
        }
        $this->object = $object;
    }

    /**
     * @param integer $index
     */
    private function boundsCheck(int $index) {
        $linkCount = count($this->links);
        if ($index < 0 || $index > $linkCount - 1) {
            $message = sprintf('The node only have %d link%s.', $linkCount, ($linkCount === 1 ? '' : 's'));
            throw new InvalidArgumentException($message);
        }
    }

    /**
     * @param integer $link
     * @return Node|null
     * @throws InvalidArgumentException
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
     * @param mixed|null $object
     */
    public function setItem($object) {
        $this->object = $object;
    }

    /**
     * @param integer   $link
     * @param Node|null $node
     */
    public function setLink(int $link, ?Node $node = null) {
        $this->boundsCheck($link);
        $this->links[$link] = $node;
    }

}
