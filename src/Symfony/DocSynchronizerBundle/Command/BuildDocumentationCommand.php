<?php

namespace Symfony\DocSynchronizerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildDocumentationCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this
            ->setName('symfony:build-documentation')
            ->setDescription('WIP')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $docService = $this->getContainer()->get('doc');

        $doc = $docService->getDocumentation('2.4', 'fr');
        $output->writeln((string) $doc);
    }
}
