<?php

namespace Symfony\DocSynchronizerBundle\Exception;

class InvalidTypeException extends \LogicException
{
    public function __construct($type, $value)
    {
        parent::__construct(sprintf('Expected a %s, got a %s.', $type, is_object($value) ? get_class($value) : gettype($value)));
    }
}
