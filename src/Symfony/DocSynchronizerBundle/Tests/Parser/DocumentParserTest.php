<?php

namespace Symfony\DocSynchronizerBundle\Tests\Parser;

use Symfony\DocSynchronizerBundle\Parser\DocumentParser;

class DocumentParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParseEmptyDocument()
    {
        $parser = new DocumentParser();
        $ast = $parser->parse('');

        $this->assertSame(array(), $ast, 'AST from empty document should be empty');
    }
}
