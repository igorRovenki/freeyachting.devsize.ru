<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TravelRepository extends EntityRepository
{
    const ORDER_BY_DELIMITER = '-';

    public function findTravelsByFilter(array $filter)
    {
        $qb = $this->createQueryBuilder('travel_repository');
        $qb
            ->select('t')
            ->from('AppBundle:Travel', 't')
        ;

        foreach ($filter as $key => $parameter) {
            if (empty($parameter)) {
                continue;
            }
            switch ($key) {
                case 'type':
                case 'dateStart':
                case 'country':
                case 'aquatory':
                case 'minChildAge':
                    $qb->andWhere("t.{$key} = :{$key}")->setParameter(":{$key}", $parameter);
                    break;
                case 'children':
                    if (in_array($parameter, ['yes', 'no'])) {
                        $choices = ['no' => 0, 'yes' => 1];
                        $qb->andWhere("t.{$key} = :{$key}")->setParameter(":{$key}", $choices[$parameter]);
                    }
                    break;
                case 'orderBy':
                    $orderBy = explode(self::ORDER_BY_DELIMITER, $parameter);
                    $qb->orderBy('t.' . $orderBy[0], $orderBy[1]);
                    break;
                default:
                    break;
            }
        }

        return $qb->getQuery()->getResult();
    }
}
