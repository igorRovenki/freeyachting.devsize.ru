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
        return [
            'bookings' => $this->getUser()->getBookings(),
            'title' => 'breadcrumbs.booked_travels'
        ];
    }

    /**
     * @Route("/history", name="travels_history")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Template()
     */
    public function travelsHistoryAction()
    {
        return [
            'bookings' => $this->getUser()->getBookings(),
            'title' => 'breadcrumbs.travels_history'
        ];
    }
}
