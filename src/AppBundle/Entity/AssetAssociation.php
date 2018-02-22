<?php

namespace AppBundle\Entity;

use Ds\Component\Association\Entity\Association;
use AppBundle\Entity\Attribute\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Ds\Component\Security\Model\Type\Secured;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AssetAssociation
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"association_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"association_input"}
 *          },
 *          "filters"={
 *              "app.asset_association.search",
 *              "app.asset_association.date"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssetAssociationRepository")
 * @ORM\Table(name="app_asset_association")
 */
class AssetAssociation extends Association implements Secured
{
    use Accessor\Asset;

    /**
     * @var \AppBundle\Entity\Asset
     * @ApiProperty
     * @Serializer\Groups({"association_output", "association_input"})
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Asset", inversedBy="associations")
     * @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $asset;
}
