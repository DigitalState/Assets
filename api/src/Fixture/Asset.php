<?php

namespace App\Fixture;

use App\Entity\Asset as AssetEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait Asset
 */
trait Asset
{
    use Yaml;

    /**
     * @var string
     */
    private $path;

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

        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $asset = new AssetEntity;
            $asset
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setIdentity($object->identity)
                ->setIdentityUuid($object->identity_uuid)
                ->setTitle((array)$object->title)
                ->setTenant($object->tenant);
            $manager->persist($asset);
            $manager->flush();
        }
    }
}
