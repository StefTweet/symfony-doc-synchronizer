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
    public function addChild(Node $child)
    {
        if (!$child instanceof Chapter) {
            throw new InvalidTypeException('Chapter', $child);
        }

        return parent::addChild($child);
    }

    public function getLineStart()
    {
        return $this->lineStart;
    }

    public function setLineStart($lineStart)
    {
        $this->lineStart = $lineStart;

        return $this;
    }

    public function getLineEnd()
    {
        return $this->lineEnd;
    }

    public function setLineEnd($lineEnd)
    {
        $this->lineEnd = $lineEnd;

        return $this;
    }

    public function getLastModification()
    {
        return $this->lastModification;
    }

    public function setLastModification(\DateTime $lastModification)
    {
        $this->lastModification = $lastModification;

        return $this;
    }

    public function toStringSuffix()
    {
        if (!$this->lastModification) {
            return;
        }

        return '('.$this->lastModification->format('Y-m-d H:i:s').')';
    }
}
