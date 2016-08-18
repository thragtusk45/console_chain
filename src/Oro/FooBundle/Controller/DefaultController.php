<?php

namespace Oro\FooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OroFooBundle:Default:index.html.twig');
    }
}
