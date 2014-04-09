<?php

namespace Symfony\DocSynchronizerBundle\Entity;

use Symfony\DocSynchronizerBundle\Exception\InvalidTypeException;

class Directory extends Node
{
    private $name = '';

    /**
     * {@inheritdoc}
     */
    public function addChild(Node $child)
    {
        if (!$child instanceof Directory && !$child instanceof File) {
            throw new InvalidTypeException('Directory|File', $child);
        }

        return parent::addChild($child);
    }

    public function createFile($name)
    {
        $file = new File();
        $file->setName($name);
        $this->addChild($file);

        return $file;
    }

    public function createDirectory($name)
    {
        $dir = new Directory();
        $dir->setName($name);
        $this->addChild($dir);

        return $dir;
    }
}
