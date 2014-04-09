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
        return array();
    }
}
