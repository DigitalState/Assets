<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Asset;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class AssetFixture
 */
abstract class AssetFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $asset = new Asset;
            $asset
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setOwner($object->identity)
                ->setOwnerUuid($object->identity_uuid)
                ->setTitle($object->title);
            $manager->persist($asset);
            $manager->flush();
        }
    }
}
