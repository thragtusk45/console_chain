<?php

namespace Oro\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OroBarBundle:Default:index.html.twig');
    }
}
