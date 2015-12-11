<?php

namespace AppBundle\Event;

use AppBundle\Entity\Traveller;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AvatorImageEventSubscriber implements EventSubscriber
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            Events::postLoad,
        ];
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Traveller) {
            if (!$entity->getPhoto()) {
                if ($entity->getGender() == Traveller::GENDER_M) {
                    $entity->setPhotoPublicUrl('/images/avatar.png');
                } else {
                    $entity->setPhotoPublicUrl('/images/avatar2.png');
                }
            } else {
                $path = $this->container->get('sonata.media.twig.extension')->path($entity->getPhoto(), 'middle');
                $entity->setPhotoPublicUrl($path);
            }
        }
    }
}
