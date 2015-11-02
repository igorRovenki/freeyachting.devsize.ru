<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TravelRepository extends EntityRepository
{
    const ORDER_BY_DELIMITER = '-';

    public function findTravelsByFilter(array $filter)
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->select('travel')
            ->from('AppBundle:Travel', 'travel')
        ;

        foreach ($filter as $key => $parameter) {
            switch ($key) {
                case 'orderBy':
                    $orderBy = explode(self::ORDER_BY_DELIMITER, $parameter);
                    $qb->orderBy('travel.' . $orderBy[0], $orderBy[1]);
                    break;
            }
        }

        return $qb->getQuery()->getResult();
    }
}
