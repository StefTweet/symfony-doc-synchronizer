<?php

namespace Symfony\DocSynchronizerBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="symfony_doc_synchronizer_default_index")
     * @Template()
     */
    public function indexAction()
    {
        $files = $this->container->get('doc')->getDocumentation('master');

        return array(
            'files' => $files->getChildren(),
        );
    }

    /**
     * @Route("/files/{filename}", name="symfony_doc_synchronizer_default_file")
     * @Template()
     */
    public function fileAction($filename)
    {
        $files = $this->container->get('doc')->getDocumentation('master');

        $current = null;
        foreach ($files->getChildren() as $file) {
            if ($file->getName() === $filename) {
                $current = $file;
            }
        }

        if (null === $current) {
            throw $this->createNotFoundException();
        }

        return array(
            'file' => $current,
        );
    }
}
