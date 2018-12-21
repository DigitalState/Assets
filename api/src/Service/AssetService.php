<?php

namespace App\Service;

use App\Entity\Asset;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AssetService
 */
final class AssetService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = Asset::class)
    {
        parent::__construct($manager, $entity);
    }
}
