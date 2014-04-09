<?php

namespace Symfony\DocSynchronizerBundle\Parser;

use Symfony\DocSynchronizerBundle\Entity\Chapter;
use Symfony\DocSynchronizerBundle\Entity\File;

class DocumentParser
{
    const LEVEL_PATTERN = "=-`:'";

    protected $levels;

    public function __construct()
    {
        $this->levels = array();
    }

    protected function getLevels()
    {
        $this->levels;
    }

    protected function addLevel($character)
    {
        return array_push($this->levels, $character);
    }

    protected function getLevel($line)
    {
        if (strlen($line) === 0) {
            return;
        }

        foreach ($this->levels as $level => $character) {
            if ($line[0] === $character) {
                return $level;
            }
        }

        $pattern = self::LEVEL_PATTERN;
        for ($i = 0; $i < strlen($pattern); $i++) {
            if ($line[0] === $pattern[$i]) {
                return $this->addLevel($pattern[$i]);
            }
        }

        return null;
    }

    public function parse(File $file, $text)
    {
        $previous = $file;
        $previousLevel = 0;
        $previousLine = null;

        foreach(explode(PHP_EOL, $text) as $lineNumber => $line) {
            $level = $this->getLevel($line);

            if (null !== $level && strlen($previousLine) === strlen($line)) {
                $chapter = new Chapter();
                $chapter->setParent($previous);
                $chapter->setName($previousLine);
                $chapter->setLineStart($lineNumber - 1);

                if ($previousLevel < $level) {
                    $previous->addChild($chapter);
                } else {
                    $diff = $previousLevel - $level;
                    for ($i = $previousLevel; $i >= $level; $i--) {
                        if ($previous instanceof Chapter) {
                            $previous->setLineEnd($lineNumber);
                            $previous = $previous->getParent();
                        }
                    }

                    $previous->addChild($chapter);
                }

                $previousLevel = $level;
                $previous = $chapter;
            }

            $previousLine = $line;
        }

        if ($previous instanceof Chapter) {
            $previous->setLineEnd($lineNumber - 1);
        }

        return $file;
    }
}
