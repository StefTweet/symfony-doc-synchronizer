<?php

namespace Symfony\DocSynchronizerBundle\Entity;

class Chapter extends Node
{
    /**
     * @var int
     */
    private $lineStart;

    /**
     * @var int
     */
    private $lineEnd;

    /**
     * @var DateTime
     */
    private $lastModification;

    /**
     * {@inheritdoc}
     */
    public function addChild($child)
    {
        if (!$child instanceof Chapter) {
            throw new InvalidTypeException('Chapter', $child);
        }

        return parent::addChild($child);
    }
}
