<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\Asset;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Migration\Fixture\ORM\ResourceFixture;

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
        $assets = $this->parse($this->getResource());

        foreach ($assets as $asset) {
            $entity = new Asset;
            $entity
                ->setUuid($asset['uuid'])
                ->setOwner($asset['owner'])
                ->setOwnerUuid($asset['owner_uuid'])
                ->setOwner($asset['identity'])
                ->setOwnerUuid($asset['identity_uuid'])
                ->setTitle($asset['title']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
