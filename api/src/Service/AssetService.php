<?php

namespace App\Service;

use App\Entity\Asset;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AssetService
 */
final class AssetService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, string $entity = Asset::class)
    {
        parent::__construct($manager, $entity);
    }
}
