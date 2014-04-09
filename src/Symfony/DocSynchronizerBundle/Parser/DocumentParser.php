<?php

namespace Symfony\DocSynchronizerBundle\Parser;

class DocumentParser
{
    CONST LEVEL_H1 = '=';
    CONST LEVEL_H2 = '-';
    CONST LEVEL_H3 = '`';
    const LEVEL_H4 = ':';
    const LEVEL_H5 = "'";

    public function parse($text)
    {
        $ast = array();

        $previousLine = '';
        $h1 = null;
        $h2 = null;
        $h3 = null;
        foreach(explode(PHP_EOL, $text) as $lineNumber => $line){
            if (isset($line[0]) && self::LEVEL_H1 === $line[0]) {
                $ast[$previousLine] = array();
                $h1 = $previousLine;
            }

            if (isset($line[0]) && self::LEVEL_H2 === $line[0]) {
                $ast[$h1][$previousLine] = array();
                $h2 = $previousLine;
            }

            if (isset($line[0]) && self::LEVEL_H3 === $line[0]) {
                $ast[$h1][$h2][$previousLine] = array();
                $h3 = $previousLine;
            }

            $previousLine = $line;
        } 

        return $ast;
    }
}
