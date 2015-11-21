<?php

namespace AppBundle\Event;

use AppBundle\Entity\User;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Sonata\MediaBundle\Provider\ImageProvider;

class UploadedFileEventSubscriber implements EventSubscriber
{
    /**
     * @var ImageProvider
     */
    private $imageProvider;

    /**
     * @param ImageProvider $imageProvider
     */
    public function __construct(ImageProvider $imageProvider)
    {
        $this->imageProvider = $imageProvider;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            Events::preUpdate,
        ];
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if ($entity instanceof User) {
            if ($args->hasChangedField('photo')) {
                if (!$args->getNewValue('photo') instanceof Media && $args->getOldValue('photo') instanceof Media) {
                    $args->setNewValue('photo', $args->getOldValue('photo'));
                } elseif ($args->getOldValue('photo') instanceof Media) {
                    /* if photo has changed, let's remove previous user photo */
                    $this->imageProvider->removeThumbnails($args->getOldValue('photo'));
                    $em->remove(
                        $em->getReference('ApplicationSonataMediaBundle:Media', $args->getOldValue('photo')->getId())
                    );
                }
            }
        }
    }
}
