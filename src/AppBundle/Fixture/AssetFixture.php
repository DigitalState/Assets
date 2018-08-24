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
        $connection = $manager->getConnection();
        $platform = $connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                $connection->exec('ALTER SEQUENCE app_asset_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_asset_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $asset = new Asset;
            $asset
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setIdentity($object->identity)
                ->setIdentityUuid($object->identity_uuid)
                ->setTitle((array) $object->title)
                ->setTenant($object->tenant);
            $manager->persist($asset);
            $manager->flush();
        }
    }
}
