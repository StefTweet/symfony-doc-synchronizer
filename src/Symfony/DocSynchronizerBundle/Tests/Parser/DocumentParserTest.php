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

    public function testParseDocument()
    {
        $parser = new DocumentParser();
        $ast = $parser->parse("H1
==

Paragraph

H2
--

H3
``

Paragraph

H4
::

Paragraph

H5
''

Paragraph");

        $this->assertSame(array(
            'H1' => array(
                'H2' => array(
                    'H3' => array()
                )
            )
        ), $ast, 'AST must have one head title and one pagraph title');
    }
}
