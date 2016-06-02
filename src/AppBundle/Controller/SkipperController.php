<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Travel;
use AppBundle\Form\TravelType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkipperController extends Controller
{
    /**
     * @Route("/travel/new", name="create_new_travel")
     * @Security("is_granted('ROLE_SKIPPER')")
     */
    public function createTravelAction(Request $request)
    {
        $travel = new Travel();
        $form = $this->createForm(new TravelType(), $travel);
        $form->handleRequest($request);

        $schemas = $this->get('sonata.media.manager.media')->findBy(['context' => 'yacht']);

        if ($form->isValid()) {
            $travel->setSkipper($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($travel);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('travel.success_created', [], 'AppBundle')
            );

            return $this->redirect($this->generateUrl('travel_show', ['id' => $travel->getId()]));
        }

        return $this->render('AppBundle:Travel:new.html.twig', [
            'form' => $form->createView(),
            'schemas' => $schemas
        ]);
    }

    /**
     * @Route("/skipper/travels", name="current_travels")
     * @Security("is_granted('ROLE_SKIPPER')")
     */
    public function skipperTravelsAction()
    {
        return $this->render('AppBundle:Skipper:travelsList.html.twig');
    }

    /**
     * @Route("/skipper/archive", name="archive_travels")
     * @Security("is_granted('ROLE_SKIPPER')")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Skipper:archiveTravelsList.html.twig');
    }
}
