<?php

namespace Symfony\DocSynchronizerBundle\Entity;

abstract class Node
{
    /**
     * @var Node
     */
    private $parent;

    /**
     * @var Node[]
     */
    private $children;

    /**
     * @return Node|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return Node
     */
    public function setParent(Node $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Node[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return Node
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * @return Node
     */
    public function addChild(Node $child)
    {
        $this->children[] = $child;

        return $this;
    }
}
