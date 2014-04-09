<?php

namespace Symfony\DocSynchronizerBundle\Entity;

use Symfony\DocSynchronizerBundle\Exception\InvalidTypeException;

class File extends Node
{
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
