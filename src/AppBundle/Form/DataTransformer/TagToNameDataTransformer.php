<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TagToNameDataTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (tag) to a string (name).
     *
     * @param  Tag|null $tag
     * @return string
     */
    public function transform($tag)
    {
        if (null === $tag) {
            return '';
        }

        return $tag->getName();
    }

    /**
     * Transforms a string (name) to an object (tag).
     *
     * @param  string $tagName
     * @return Tag|null
     * @throws TransformationFailedException if object (tag) is not found.
     */
    public function reverseTransform($tagName)
    {
        // empty tag name? It's optional, so that's ok
        if (empty($tagName)) {
            return;
        }

        $tag = $this->manager
            ->getRepository('AppBundle:Tag')
            ->find($tagName)
        ;

        if (null === $tag) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An tag with name "%s" does not exist!',
                $tagName
            ));
        }

        return $tag;
    }
}