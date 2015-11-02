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

        switch ($this->request->get('_route')) {
            case 'search_travel':
                $menu->addChild('breadcrumbs.search_results', ['route' => 'search_travel']);
                $menu['breadcrumbs.search_results']->setCurrent(true);
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
