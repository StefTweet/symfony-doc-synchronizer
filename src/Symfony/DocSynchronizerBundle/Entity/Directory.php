<?php

namespace Symfony\DocSynchronizerBundle\Entity;

class Directory extends Node
{
    private $name = '';

    /**
     * {@inheritdoc}
     */
    public function addChild(Node $child)
    {
        if (!$child instanceof Directory && !$child instanceof Document) {
            throw new InvalidTypeException('Directory|Document', $child);
        }

        return parent::addChild($child);
    }
}
