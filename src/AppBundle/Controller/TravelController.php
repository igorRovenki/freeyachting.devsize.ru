<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Booking;
use AppBundle\Form\BookingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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

    /**
     * @Route("/travel/{id}/booking", name="travel_booking")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Template()
     */
    public function bookTravelAction(Travel $travel, Request $request)
    {
        $booking = new Booking();
        $form = $this->createForm(new BookingType(), $booking);

        return ['travel' => $travel, 'form' => $form->createView()];
    }

    /**
     * @Route("/travel/{id}/booking/new", name="booking_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Method(methods={"POST"})
     */
    public function createAction(Travel $travel, Request $request)
    {
        $booking = new Booking();

        $form = $this->createForm(new BookingType(), $booking);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $booking->setStatus(Booking::STATUS_PENDING);
            $booking->setTravel($travel);
            $booking->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('travel.success_booked', [], 'AppBundle')
            );

            return $this->redirect($this->generateUrl('travel_show', ['id' => $travel->getId()]));
        }

        return $this->render('AppBundle:Travel:bookTravel.html.twig', [
            'travel' => $travel,
            'form' => $form->createView()
        ]);
    }
}
