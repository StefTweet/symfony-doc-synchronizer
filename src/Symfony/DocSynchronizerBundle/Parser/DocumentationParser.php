<?php

namespace Symfony\DocSynchronizerBundle\Parser;

use Gitonomy\Git\Repository;
use Symfony\DocSynchronizerBundle\Entity\Directory;

class DocumentationParser
{
    /**
     * @return Directory
     */
    public function parse(Repository $repository)
    {
        $dir = new Directory();


        return $dir;
    }
}
