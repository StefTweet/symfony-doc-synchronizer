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
    private $children = array();

    /**
     * @var string
     */
    private $name;

    /**
     * @return Node|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
        $child->setParent($this);

        return $this;
    }

    public function toString($level = 0)
    {
        $padding = str_repeat('  ', $level);

        $result = $padding.$this->name."\n";
        foreach ($this->children as $child) {
            $result .= $child->toString($level + 1);
        }

        return $result;
    }

    public function __toString()
    {
        return $this->toString();
    }
}
