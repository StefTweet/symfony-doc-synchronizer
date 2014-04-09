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
}
