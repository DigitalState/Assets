<?php

namespace AppBundle\Service;

use AppBundle\Entity\Asset;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AssetService
 */
class AssetService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Asset::class)
    {
        parent::__construct($manager, $entity);
    }
}
