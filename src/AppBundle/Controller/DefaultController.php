<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template(template="AppBundle:default:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $countries = $em->getRepository('AppBundle:Country')->findAll();
        $aquatories = $em->getRepository('AppBundle:Aquatory')->findAll();

        return ['countries' => $countries, 'aquatories' => $aquatories];
    }
}
