<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Travel;

/**
 * Travel controller.
 */
class TravelController extends Controller
{
    /**
     * Search Travels
     *
     * @Route("/travel/search", name="search_travel")
     * @Template()
     * @param Request $request
     * @return array
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $travels = $em->getRepository('AppBundle:Travel')->findTravelsByFilter($request->query->all());

        return ['travels' => $travels];
    }

    /**
     * Finds and displays a Travel
     *
     * @Route("/travel/{id}", name="travel_show")
     * @Template()
     * @param Travel $travel
     * @return array
     */
    public function showAction(Travel $travel)
    {
        return ['travel' => $travel];
    }
}
