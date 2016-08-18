<?php

namespace Oro\ChainCommandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OroChainCommandBundle:Default:index.html.twig');
    }
}
