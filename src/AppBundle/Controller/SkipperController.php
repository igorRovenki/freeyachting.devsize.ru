<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Travel;
use AppBundle\Form\TravelType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SkipperController extends Controller
{
    /**
     * @Route("/travel/new", name="create_new_travel")
     * @Security("is_granted('ROLE_SKIPPER')")
     */
    public function createTravelAction(Request $request)
    {
        $form = $this->createForm(new TravelType(), new Travel());
        $form->handleRequest($request);

        return $this->render('AppBundle:Travel:new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/skipper/travels", name="current_travels")
     */
    public function skipperTravelsAction()
    {
        return new Response();
    }

    /**
     * @Route("/skipper/archive", name="archive_travels")
     */
    public function indexAction()
    {
        return new Response();
    }
}
