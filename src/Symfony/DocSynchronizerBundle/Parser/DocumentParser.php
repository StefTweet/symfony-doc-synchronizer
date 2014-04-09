<?php

namespace Symfony\DocSynchronizerBundle\Parser;

use Symfony\DocSynchronizerBundle\Entity\Chapter;
use Symfony\DocSynchronizerBundle\Entity\File;

class DocumentParser
{
    CONST LEVEL_H1 = '=';
    CONST LEVEL_H2 = '-';
    CONST LEVEL_H3 = '`';
    const LEVEL_H4 = ':';
    const LEVEL_H5 = "'";

    protected static function getLevels()
    {
        return array(
            self::LEVEL_H1 => 1,
            self::LEVEL_H2 => 2,
            self::LEVEL_H3 => 3,
            self::LEVEL_H4 => 4,
            self::LEVEL_H5 => 5,
        );
    }
    public function parse(File $file, $text)
    {

        $previous = $file;
        $previousLevel = 0;
        $previousLine = null;

        foreach(explode(PHP_EOL, $text) as $lineNumber => $line) {
            foreach (self::getLevels() as $character => $level) {
                if (isset($line[0]) && $character === $line[0]) {
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

                if ($previous instanceof Chapter) {
                    $previous->setLineEnd($lineNumber - 1);
                }

                $previousLine = $line;
            }
        }

        return $file;
    }
}
