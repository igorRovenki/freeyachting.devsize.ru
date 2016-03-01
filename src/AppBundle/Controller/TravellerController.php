<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TravellerController
 * @Route("/traveller")
 */
class TravellerController extends Controller
{
    /**
     * @Route("/booked-travels", name="booked_travels")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Template()
     */
    public function bookedTravelsAction()
    {
        /** @var User $user */
        $user = $this->getUser();
        $travels = $user->getBookings()->map(function ($booking) {
            return $booking->getTravel();
        });

        return ['travels' => $travels, 'title' => 'breadcrumbs.booked_travels'];
    }

    /**
     * @Route("/history", name="travels_history")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function travelsHistoryAction()
    {
        /** @var User $user */
        $user = $this->getUser();
        $travels = $user->getBookings()->map(function ($booking) {
            return $booking->getTravel();
        });

        return $this->render('AppBundle:Traveller:bookedTravels.html.twig', [
            'travels' => $travels,
            'title' => 'breadcrumbs.travels_history'
        ]);
    }
}
