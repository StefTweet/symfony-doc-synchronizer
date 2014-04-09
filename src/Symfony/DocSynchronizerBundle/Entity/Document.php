<?php

namespace Symfony\DocSynchronizerBundle\Entity;

use Symfony\DocSynchronizerBundle\Exception\InvalidTypeException;

class Document extends Node
{
    public function addChild($child)
    {
        if (!$child instanceof Chapter) {
            throw new InvalidTypeException('Chapter', $child);
        }

        return parent::addChild($child);
    }
}
