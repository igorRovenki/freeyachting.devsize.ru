<?php

namespace AppBundle\Form\DataTransformer;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArrayCollectionToUploadedFileTransformer implements DataTransformerInterface
{
    /**
     * Transforms a value from the original representation to a transformed representation.
     *
     * @param Media $media
     * @return mixed The value in the transformed representation
     * @internal param mixed $value The value in the original representation
     */
    public function transform($media)
    {
        return $media ? new UploadedFile('images/avatar.png', 'original_name') : null;
    }

    /**
     * Transforms a value from the transformed representation to its original
     * representation.
     *
     * @param UploadedFile $submittedPhoto
     * @return mixed The value in the original representation
     * @internal param mixed $value The value in the transformed representation
     */
    public function reverseTransform($submittedPhoto)
    {
        if ($submittedPhoto instanceof UploadedFile) {
            $media = new Media();
            $media->setBinaryContent($submittedPhoto->getRealPath());
            $media->setProviderName('sonata.media.provider.image');
            $media->setContext('travel');

            $collection = new ArrayCollection();
            $collection->add($media);

            return $collection;
        }

        return null;
    }
}
