<?php

namespace Symfony\DocSynchronizerBundle\Entity;

class Directory extends DirectoryElement
{
    /**
     * {@inheritdoc}
     */
    public function addChild($child)
    {
        if (!$child instanceof Directory && !$child instanceof Document) {
            throw new InvalidTypeException('Directory|Document', $child);
        }

        return parent::addChild($child);
    }
}
