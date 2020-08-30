<?php

namespace App\Fixture;

use App\Entity\Asset as AssetEntity;
use DateTime;
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
        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $asset = new AssetEntity;
            $asset
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setIdentity($object->identity)
                ->setIdentityUuid($object->identity_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);

            if (null !== $object->created_at) {
                $date = new DateTime;
                $date->setTimestamp($object->created_at);
                $asset->setCreatedAt($date);
            }

            $manager->persist($asset);
        }

        $manager->flush();
    }
}
