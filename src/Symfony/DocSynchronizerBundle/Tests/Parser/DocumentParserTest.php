<?php

namespace Symfony\DocSynchronizerBundle\Tests\Parser;

use Symfony\DocSynchronizerBundle\Entity\File;
use Symfony\DocSynchronizerBundle\Parser\DocumentParser;

class DocumentParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParseEmptyDocument()
    {
        $file = new File();
        $parser = new DocumentParser();
        $parser->parse($file, '');

        $this->assertSame('
', $file->toString(), 'AST from empty document should be empty');
    }

    public function testParseDocument()
    {
        $file = new File();
        $parser = new DocumentParser();

        $parser->parse($file, "H1-1
====

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

Paragraph

H1-2
====

H2
--

Paragraph");

        $this->assertSame(array(
            'H1-1' => array(
                'H2' => array(
                    'H3' => array(),
                ),
            ),
            'H1-2' => array(
                'H2' => array(),
            ),
        ), $ast, 'AST must have one head title and one pagraph title');
    }
}
