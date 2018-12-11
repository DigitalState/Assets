<?php

namespace App\Service;

use App\Entity\AssetAssociation;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AssetAssociationService
 */
final class AssetAssociationService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, string $entity = AssetAssociation::class)
    {
        parent::__construct($manager, $entity);
    }
}
