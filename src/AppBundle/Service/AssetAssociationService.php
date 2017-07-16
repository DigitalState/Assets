<?php

namespace AppBundle\Service;

use AppBundle\Entity\AssetAssociation;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AssetAssociationService
 */
class AssetAssociationService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = AssetAssociation::class)
    {
        parent::__construct($manager, $entity);
    }
}
