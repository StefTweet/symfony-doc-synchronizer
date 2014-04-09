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
        $doc = $this->getContainer()->get('doc');
        $languages = $doc->getLanguages();

        foreach ($languages as $language) {
            $versions = $doc->getVersions($language);
            foreach ($versions as $version) {
                $output->write(sprintf('Updating %s/%s...', $language, $version));
                $doc->getDocumentation($version, $language, true);
                $output->writeln('OK');
            }
        }
    }
}
