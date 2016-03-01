<?php

namespace AppBundle\Menu;

use AppBundle\Entity\TravelRepository;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var Request
     */
    private $request;

    public function __construct(FactoryInterface $factory, Request $request)
    {
        $this->factory = $factory;
        $this->request = $request;
    }

    public function createBreadcrumbsMenu()
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'breadcrumb');
        $menu->addChild('breadcrumbs.homepage', ['route' => 'homepage']);
        $route = $this->request->get('_route');

        switch ($route) {
            case 'search_travel':
            case 'fos_user_registration_register':
            case 'fos_user_profile_edit':
            case 'fos_user_profile_show':
            case 'fos_user_security_login':
            case 'fos_user_change_password':
            case 'fos_user_resetting_check_email':
            case 'fos_user_resetting_reset':
            case 'fos_user_resetting_send_email':
            case 'travel_booking':
            case 'booked_travels':
            case 'travels_history':
                $menu->addChild('breadcrumbs.' . $route)->setCurrent(true);
                break;
            case 'travel_show':
                $menu->addChild('breadcrumbs.search_travel', ['route' => 'search_travel']);
                $menu->addChild('breadcrumbs.' . $route)->setCurrent(true);
                break;
        }

        return $menu;
    }

    public function createSearchMenu()
    {
        $menu = $this->factory->createItem('root');
        $items = ['search.sort.price', 'search.sort.date_start', 'search.sort.skipper_rating'];
        $options = [];

        foreach ($items as $item) {
            switch ($item) {
                case 'search.sort.price':
                    $options = [
                        'route' => 'search_travel',
                        'routeParameters' => ['orderBy' => $this->getOrderBy('dayPrice')]
                    ];
                    break;
                case 'search.sort.date_start':
                    $options = [
                        'route' => 'search_travel',
                        'routeParameters' => ['orderBy' => $this->getOrderBy('dateStart')]
                    ];
                    break;
                case 'search.sort.skipper_rating':
                    $options = ['route' => 'search_travel'];
                    break;
            }
            $menu->addChild($item, $options);
            $menu[$item]->setLinkAttribute('class', 'btn btn-9');
        }

        if ($this->request->get('orderBy')) {
            $orderBy = explode(TravelRepository::ORDER_BY_DELIMITER, $this->request->get('orderBy'));
            $sort = $orderBy[0];

            if ($sort == 'dayPrice') {
                $menu['search.sort.price']->setLinkAttribute('class', 'btn btn-9 active');
            }
            if ($sort == 'dateStart') {
                $menu['search.sort.date_start']->setLinkAttribute('class', 'btn btn-9 active');
            }
            if ($sort == 'skipperRating') {
                $menu['search.sort.skipper_rating']->setLinkAttribute('class', 'btn btn-9 active');
            }
        }

        return $menu;
    }

    public function createProfileMenu()
    {
        $menu = $this->factory->createItem('root');
        $items = [
            'fos_user_profile_show',
            'travels_history',
            'booked_travels',
        ];

        foreach ($items as $route) {
            $menu->addChild('profile_menu.' . $route, ['route' => $route]);
            $menu['profile_menu.' . $route]->setLinkAttribute(
                'class',
                'btn btn-9' . ($this->request->get('_route') == $route ? ' active' : '')
            );
        }

        return $menu;
    }

    private function getOrderBy($field)
    {
        if ($this->request->get('orderBy')) {
            $orderBy = explode(TravelRepository::ORDER_BY_DELIMITER, $this->request->get('orderBy'));
            list($sort, $order) = $orderBy;

            if ($field === $sort) {
                return $order == 'asc' ? $field . '-desc' : $field . '-asc';
            }
        }

        return $field . '-asc';
    }
}
