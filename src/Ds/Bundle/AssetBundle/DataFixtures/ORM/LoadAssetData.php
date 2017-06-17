<?php

namespace Ds\Bundle\AssetBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\AssetBundle\Entity\Asset;

/**
 * Class LoadAssetData
 */
class LoadAssetData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $assets = $this->parse(__DIR__.'/../../Resources/data/{server}/assets.yml');

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
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
