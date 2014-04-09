<?php

namespace Symfony\DocSynchronizerBundle\Entity;

use Symfony\DocSynchronizerBundle\Exception\InvalidTypeException;

class File extends Node
{
    private $name;

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
     * {@inheritdoc}
     */
    public function addChild(Node $child)
    {
        if (!$child instanceof Chapter) {
            throw new InvalidTypeException('Chapter', $child);
        }

        return parent::addChild($child);
    }
}
