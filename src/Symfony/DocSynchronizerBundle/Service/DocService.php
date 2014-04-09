<?php

namespace Symfony\DocSynchronizerBundle\Service;

use Gitonomy\Git\Admin;
use Gitonomy\Git\Repository;
use Symfony\DocSynchronizerBundle\Parser\DocumentationParser;

class DocService
{
    private $cacheDir;

    public function __construct($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    /**
     * @return Directory
     */
    public function getDocumentation($version, $locale = null)
    {
        $targetDir = $this->getCacheDir($locale);
        if (!is_dir($targetDir)) {
            $repository = $this->cloneRepository($targetDir, $locale);
        } else {
            $repository = new Repository($targetDir);
        }

        $cacheFile = $this->cacheDir.'/cache_'.$version.'_'.$locale;

        if (!file_exists($cacheFile)) {
            $parser = new DocumentationParser();
            $documentation = $parser->parse($repository, $version);
            file_put_contents($cacheFile, serialize($documentation));
        } else {
            $documentation = unserialize(file_get_contents($cacheFile));
        }

        return $documentation;
    }

    private function getCacheDir($locale)
    {
        return $this->cacheDir.'/'.$locale;
    }

    /**
     * @return Repository
     */
    public function cloneRepository($target, $locale)
    {
        $parent = dirname($target);
        if (!is_dir($parent)) {
            mkdir($parent, 0777, true);
        }

        $urls = array(
            'en'  => 'https://github.com/symfony/symfony-docs.git',
            'fr'  => 'https://github.com/symfony-fr/symfony-docs-fr.git',
        );

        if (!isset($urls[$locale])) {
            throw new \InvalidArgumentException('Expected %s, got %s', implode(', ', array_keys($urls)), $locale);
        }

        $url = $urls[$locale];

        return Admin::cloneTo($target, $url);
    }

    public function getLanguages()
    {
        return array('en', 'fr');
    }

    public function getVersions($language)
    {
        return array('master', '2.4', '2.3', '2.2', '2.1');
    }
}
