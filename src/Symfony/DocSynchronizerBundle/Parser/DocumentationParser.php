<?php

namespace Symfony\DocSynchronizerBundle\Parser;

use Gitonomy\Git\Blob;
use Gitonomy\Git\Repository;
use Gitonomy\Git\Tree;
use Symfony\DocSynchronizerBundle\Entity\Directory;
use Symfony\DocSynchronizerBundle\Entity\File;

class DocumentationParser
{
    /**
     * @return Directory
     */
    public function parse(Repository $repository, $version)
    {
        $dir = new Directory();

        $commit = $repository->getRevision($version)->getCommit();

        $this->addChildren($dir, $commit->getTree());

        return $dir;
    }

    private function addChildren(Directory $dir, Tree $tree)
    {
        foreach ($tree->getEntries() as $name => $row) {
            list($mode, $entry) = $row;
            if ($entry instanceof Blob) {
                $file = $dir->createFile($name);
                $this->parseDocument($file, $entry);
            } elseif ($entry instanceof Tree) {
                $sub  = $dir->createDirectory($name);
                $this->addChildren($sub, $entry);
            }
        }
    }

    private function parseDocument(File $file, Blob $blob)
    {
        // Julien ici
    }
}
